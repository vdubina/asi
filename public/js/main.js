$(document).ready(function () {
    window._token = $('meta[name="csrf-token"]').attr('content')

    moment.updateLocale('en', {
        week: { dow: 1 } // Monday is the first day of the week
    })

    $('.date').datetimepicker({
        format: 'MM/DD/YYYY',
        locale: 'en',
        icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
        }
    })

    $('.datetime').datetimepicker({
        format: 'MM/DD/YYYY HH:mm:ss',
        locale: 'en',
        sideBySide: true,
        icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
        }
    })

    $('.timepicker').datetimepicker({
        format: 'HH:mm:ss',
        icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
        }
    })

    $('.select-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', 'selected')
        $select2.trigger('change')
    })
    $('.deselect-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', '')
        $select2.trigger('change')
    })

    $('.select2').select2()

    $('.treeview').each(function () {
        var shouldExpand = false
        $(this).find('li').each(function () {
            if ($(this).hasClass('active')) {
                shouldExpand = true
            }
        })
        if (shouldExpand) {
            $(this).addClass('active')
        }
    })

    $('a[data-widget^="pushmenu"]').click(function () {
        setTimeout(function () {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        }, 350);
    })

    $('.sortable').nestedSortable({
        forcePlaceholderSize: true,
        handle: 'div',
        helper: 'clone',
        items: 'li',
        opacity: .6,
        placeholder: 'placeholder',
        revert: 250,
        tabSize: 25,
        tolerance: 'pointer',
        toleranceElement: '> div',
        maxLevels: 4,

        isTree: true,
        expandOnHover: 700,
        startCollapsed: false
    });

    $('.disclose').on('click', function () {
        $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
    });
})

function resizeSwagger(obj) {
    obj.style.height = (obj.contentWindow.document.documentElement.scrollHeight + 300) + 'px';

    var new_style_element = document.createElement("style");
    new_style_element.textContent = ".information-container { display: none; }"
    obj.contentDocument.head.appendChild(new_style_element);
}


function setSortable(selector, url) {
    $(selector).click(function (e) {
        // get the current tree order
        arraied = $('ol.sortable').nestedSortable('toArray', { startDepthCount: 0 });

        // log it
        //console.log(arraied);

        // send it with POST
        $.ajax({
            url: url,
            type: 'POST',
            data: { tree: arraied },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
            .done(function () {
                showNotySuccess("Done!<br>Your changes has been saved.");
            })
            .fail(function () {
                showNotyError("Error!<br>Your changes has not been saved.");
            })
            .always(function () {
                console.log("complete");
            });
    });
}

function showNotySuccess(text)
{
    new Noty({
        theme: 'bootstrap-v4',
        type: "success",
        timeout: 5000,
        progressBar: true,
        text: text,
        onClose: function() {

        },
    }).show();
}


function showNotyError(text)
{
    new Noty({
        theme: 'bootstrap-v4',
        type: "error",
        timeout: 5000,
        progressBar: true,
        modal: true,
        text: text
    }).show();
}
