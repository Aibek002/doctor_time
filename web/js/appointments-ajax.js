(function($){
    var $bar = $('.filter-bar');
    var filterUrl = $bar.data('url');

    if (!filterUrl) {
        console.error('Filter URL not set on .filter-bar[data-url]');
        return;
    }

    function bindRedirects() {
        $(document).off('click', '.redirect_btn').on('click', '.redirect_btn', function() {
            window.location.href = $(this).data('link');
        });
    }
    bindRedirects();

    function renderAppointments(list) {
        if (!list || !list.length) {
            $('.appointments-list-container').html('<div style="text-align:center; color:#DC2626;">Нет записей для выбранного пациента.</div>');
            return;
        }
        var html = '';
        list.forEach(function(a){
            var patientName = (a.first_name || a.last_name) ? ((a.first_name||'') + ' ' + (a.last_name||'')) : ('ID ' + a.patient_id);
            html += `
                <div class="appointment-card">
                    <h3>👨‍⚕️ ${escapeHtml(a.doctor_name)}</h3>
                    <div>🧑‍🤝‍🧑 Пациент: <strong>${escapeHtml(patientName.trim())}</strong></div>
                    <div>🩺 Специализация: <strong>${escapeHtml(a.specialization)}</strong></div>
                    <div>⏰ Дата и время: <strong>${escapeHtml(a.date_time)}</strong></div>
                </div>
            `;
        });
        $('.appointments-list-container').html(html);
        bindRedirects();
    }

    function escapeHtml(str) {
        if (str === null || str === undefined) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }

    function doFilter(page) {
        var data = {
            patient: $('#patient-filter').val() || '',
            doctor: $('#doctor-filter').val() || '',
            specialization: $('#specialization-filter').val() || ''
        };
        if (page) data.page = page;

        $('#filter-loader').show();
        $('.appointments-list-container').html('<div style="text-align:center; padding:20px;">Загрузка...</div>');

        $.ajax({
            url: filterUrl,
            type: 'GET',
            dataType: 'json',
            data: data
        })
        .done(function(resp){
            if (resp && resp.success) {
                renderAppointments(resp.data || []);
            } else {
                $('.appointments-list-container').html('<div style="text-align:center; color:#DC2626;">Нет данных.</div>');
            }
        })
        .fail(function(xhr){
            console.error('AJAX error:', xhr.status, xhr.responseText);
            $('.appointments-list-container').html('<div style="text-align:center; color:#DC2626;">Ошибка при загрузке.</div>');
        })
        .always(function(){
            $('#filter-loader').hide();
        });
    }

    // события
    $bar.on('change', '#patient-filter, #doctor-filter, #specialization-filter', function(){
        doFilter();
    });

    // перехват пагинации (если решишь возвращать HTML + pager — тогда нужно менять подход)
    $(document).on('click', '.appointments-list-container .pagination a', function(e){
        e.preventDefault();
        var href = $(this).attr('href') || '';
        var m = href.match(/[?&]page=(\d+)/);
        var page = m ? m[1] : null;
        doFilter(page);
    });

})(jQuery);
