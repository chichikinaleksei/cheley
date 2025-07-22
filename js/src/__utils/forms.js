// const Forms = () => {
//   const hubspotForm = document.querySelectorAll('.hbspt-form form.hs-custom-style');

//   //Remove hubspot's styling from forms
//   if (hubspotForm) {
//     hubspotForm.forEach(function(form) {
//       form.classList.remove('hs-custom-style');
//     });
//   }
// };

const $ = jQuery.noConflict();

const forms = () => {
    // Apply select2 plugin to gform select fields
    const singleSelect = $('.gform_wrapper').find('select:not([multiple]):not([class*=select2])');
    const multiSelect = $('.gform_wrapper').find('select[multiple]:not([class*=select2])');

    if (singleSelect.length) {
        singleSelect.each((i, select) => {
            const selectSingle = $(select);
            const gfPlaceholder = selectSingle.children('.gf_placeholder');
            const ariaLabel = selectSingle.attr('aria-label');
            let placeholderText = 'Select item';

            if (gfPlaceholder.length) {
                placeholderText = gfPlaceholder.text();
            } else if (ariaLabel) {
                placeholderText = ariaLabel;
            }

            selectSingle.select2({
                minimumResultsForSearch: Infinity,
                placeholder: placeholderText,
                width: '100%',
            });

            selectSingle.on('select2:close', () => {
                $('.select2-selection--single').blur();
            });

            $(window).on('resize', () => {
                selectSingle.select2('close');
            });
        });
    }

    if (multiSelect.length) {
        multiSelect.each((i, select) => {
            const selectSingle = $(select);
            const placeholderText = 'Select item';

            selectSingle.select2MultiCheckboxes({
                minimumResultsForSearch: Infinity,
                placeholder: placeholderText,
                width: '100%',
                templateSelection: function (selected) {
                    return selected.length ? (typeof selected === 'object' ? selected.join(', ') : selected) : placeholderText;
                }
            });

            selectSingle.on('select2:close', () => {
                $('.select2-selection--single').blur();
            });

            $(window).on('resize', () => {
                selectSingle.select2('close');
            });
        });
    }

    // GF datepicker preinit settings
    gform.addFilter('gform_datepicker_options_pre_init', (optionsObj) => {
        optionsObj.firstDay = 1;
        optionsObj.changeMonth = false;
        optionsObj.changeYear = false;

        return optionsObj;
    });

	$("#input_9_30_1").select2({
		placeholder: "Month",
		allowClear: true
	});
	$("#input_9_30_2").select2({
		placeholder: "Day",
		allowClear: true
	});
	$("#input_9_30_3").select2({
		placeholder: "Year",
		allowClear: true
	});

	$("#input_9_24_1").select2({
		placeholder: "Month",
		allowClear: true
	});
	$("#input_9_24_2").select2({
		placeholder: "Day",
		allowClear: true
	});
	$("#input_9_24_3").select2({
		placeholder: "Year",
		allowClear: true
	});
};

export default forms;

