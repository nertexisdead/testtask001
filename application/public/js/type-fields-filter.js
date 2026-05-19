(function () {
    function parentBlock(element) {
        return element.closest('p, .form-row, .field, label, div') || element;
    }

    function updateFields(select) {
        var selectedValue = String(select.value);
        var scope = select.closest('form') || document;

        scope.querySelectorAll('[name]').forEach(function (element) {
            if (element === select) {
                parentBlock(element).hidden = false;
                return;
            }

            var name = element.getAttribute('name') || '';
            parentBlock(element).hidden = !name.includes(selectedValue);
        });
    }

    function init() {
        document.querySelectorAll('select[name="type_val"], select[name="type"]').forEach(function (select) {
            select.addEventListener('change', function () {
                updateFields(select);
            });

            updateFields(select);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
