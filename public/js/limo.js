// Мобильная версия
var IS_MOBILE = false;

function strpos (haystack, needle, offset) {
	var i = (haystack+'').indexOf(needle, (offset || 0));
	return i === -1 ? false : i;
}


/**
 * Step 1
 */
var Step1 = {
	selectedPickUpAddress: '',
	selectedDropOffAddress: '',
    getDate: function(date) {
        var valueDate = 0;

        if (IS_MOBILE) {
            valueDate = date.split('-');
            valueDate = new Date(valueDate[0], valueDate[1] - 1, valueDate[2]);
        }
        else {
            valueDate = date.split('/');
            valueDate = new Date(valueDate[2], valueDate[0] - 1, valueDate[1]);
        }
        return valueDate;
    },
	init : function() {
        if (IS_MOBILE) {

        }
        else {
            $('#OrderDate').datepicker({
                minDate: minDate,
                numberOfMonths: 2,
                onClose : function(text, inst) {
                    $('#OrderMinutes').blur();
                }
            });
        }

        // Order Type
        var $orderTo = $('#OrderTo');
		$orderTo.change(function() {
            var to = $(this).val();

			/// Show drop Off Time fields for "Hourly Charter"
			if (to == 4) {
				$('#dropoffTime').show();
			}
			else {
				$('#dropoffTime').hide();
			}

			/// Pick Up
			if (to == 2) {
				$('#divFromAirport').show();
				$('#divPickupAdress').hide();
			}
			else {
				$('#divFromAirport').hide();
				$('#divPickupAdress').show();
			}

			/// Drop Off
			if (to == 1) {
				$('#divToAirport').show();
				$('#divDropoffAdress').hide();
			}
			else if (to == 4) {
				$('#divToAirport').hide();
				$('#divDropoffAdress').hide();
			}
			else {
				$('#divToAirport').hide();
				$('#divDropoffAdress').show();
			}
		});
        $orderTo.change();

		$('#OrderHour').change(function() {
			$('#OrderMinutes').blur();
		});

		jQuery.validator.addMethod('hourRequired', function(value, element, params) {
			return $('#OrderHour').val();
		}, LNG['required']);

		/// minHour check
		jQuery.validator.addMethod('minHour', function(value, element, params) {
			if ($('#OrderDate').val() != minDay) {
				return true;
			}

            var hours = $('#OrderHour').val();
            var minutes = $('#OrderMinutes').val();

			/// Если ZIP введён, вычисляем время пути от Охары
			var time2ZIP = 0;

			if ($('#OrderTo').val() == 2) {
				if ($('#OrderFromAirport').val() == 2) {
					/// TODO время до Midway
					time2ZIP = 1;
				}
			}
			else {
                var pickupAddress = $('#OrderPickupAddress').val();

				if (/\b\d{5}\b/.test(pickupAddress)) {
					$.ajaxSetup({async: false});
					$.post('/api/time_from_ohare', {'address' : pickupAddress}, function(data){
						$(element).attr('time2ZIP', data.result);
					});

					time2ZIP = $(element).attr('time2ZIP');
					$.ajaxSetup({async: true});
				}
			}

            var now = new Date();

			return parseInt(hours) + (parseInt(minutes) / 60) >= parseInt(minTime) + (now.getMinutes() / 60) + parseInt(time2ZIP);
		}, LNG['preHours']);

		jQuery.validator.addMethod('notHourPast', function(value, element, params) {
			value = $('#OrderHour').val();

            var valueDate = Step1.getDate($('#OrderDate').val());
			var today = new Date();

			/// Сегодня
			if (today.getFullYear() == valueDate.getFullYear() && today.getMonth() == valueDate.getMonth() && today.getDate() == valueDate.getDate()) {
				return parseInt(value) >= parseInt(today.getHours())
			}
			else {
				return true;
			}
		}, LNG['notPast']);

		/// Not Past
		jQuery.validator.addMethod('notPast', function(value, element, params) {
            // Мобильная версия
            var valueDate = Step1.getDate($('#OrderDate').val());

			var minimalDate = new Date();
			minimalDate = new Date(minimalDate.getFullYear(), minimalDate.getMonth(), minimalDate.getDate());
			if (minDate == 1) {
				minimalDate = new Date(minimalDate.getFullYear(), minimalDate.getMonth(), minimalDate.getDate() + 1);
			}

			return minimalDate.getTime() <= valueDate.getTime();
		}, LNG['notPast']);

		/// Minimum charter hours
		jQuery.validator.addMethod('minCharter', function(value, element, params) {
			return Math.floor(value / 60) >= minCharterHours;
		}, LNG['minCharter']);

		jQuery.validator.addMethod('zipRequired', function(value, element, params) {
			return /\b\d{5}\b/.test(value);
		}, LNG['zipRequired']);

		jQuery.validator.addMethod('zipExists', function(value, element, params) {
			var zip = /\b\d{5}\b/.exec(value);

			if (zip == null) {
				return true;
			}

			zip = zip[0];

			if (zip in zipExistsCache) {
				return zipExistsCache[zip];
			} else {
				$.ajaxSetup({async: false});

				$.get('/api/zip-code-exists/' + zip, function(data){
                    const result = data.result;
                    $(element).attr('zipexists', result);
					zipExistsCache[zip] = parseInt(result);
				});

				$.ajaxSetup({async: true});

				return zipExistsCache[zip];
			}
		}, LNG['zipNotExists']);

		jQuery.validator.addMethod('correctPickUpAddress', function(value, element, params) {
			return value == Step1.selectedPickUpAddress;
		}, LNG['needSelectFromList']);

		jQuery.validator.addMethod('correctDropOffAddress', function(value, element, params) {
			return value == Step1.selectedDropOffAddress;
		}, LNG['needSelectFromList']);

		$('#OrderStep1Form').validate({
			rules: {
				'data[Order][pass_number]' : 'required',
				'data[Order][date]' : {
					required:true,
					date: true,
					notPast: true
				},
// 				'data[Order][hour]' : {
// 					required : true,
// 					notHourPast: true,
// 					minHour : true
// 				},
				'data[Order][minutes]' : {
					hourRequired : true,
					notHourPast: true,
					minHour : true
				},
				'data[Order][charter_minutes]' : {
					required : true,
					minCharter : true
				},
				'data[Order][pickup_address]' : {
					required : true,
					zipRequired: true,
					zipExists : true,
					correctPickUpAddress: true
				},
				'data[Order][dropoff_address]' : {
					required : true,
					zipRequired: true,
					zipExists : true,
					correctDropOffAddress: true
				}
			},
			messages: {
				'data[Order][pass_number]' : LNG['required'],
				'data[Order][date]' : {
					required: LNG['required'],
					date: LNG['validateDate']
				},
// 				'data[Order][hour]' : {
// 					required : LNG['required']
// 				},
				'data[Order][minutes]' : {
					hourRequired : LNG['required']
				},
				'data[Order][charter_minutes]' : {
					required : LNG['required']
				},
				'data[Order][pickup_address]' : {
					required : LNG['required']
				},
				'data[Order][dropoff_address]' : {
					required : LNG['required']
				}
			}
		});

		// Autocomplite
		$('#OrderPickupAddress').autocomplete({
			// source: '/order/zip_codes/auto',
			source: function( request, response ) {
				var term = request.term;

				$.getJSON("/api/address/autocomplete", request, function( data, status, xhr ) {
					if (data.length == 1) {
						if (data[0].value == term) {
							return false;
						}

						if (/^\d{5}$/.test(term)) {
							var zipPattern = new RegExp(term + "$");
							if (zipPattern.test(data[0].value)) {
								Step1.selectedPickUpAddress = data[0].value;
								$('#OrderPickupAddress').val(data[0].value);
								response();
								return false;
							}
						}
					}

				  	response( data );
				});
		  	},
			minLength: 2,
			close: function(event, ui) {
				$(this).blur();
				$('#OrderHour').blur();
			},
			select: function(event, ui) {
				Step1.selectedPickUpAddress = ui.item.value;
			}
		}).focus(function () {
			$(this).autocomplete("search");
		});

		// Проверка предустановленного значения при загрузке страницы
		if ($('#OrderPickupAddress').val()) {
			$.post(
				'/order/zip_codes/check',
				{term: $('#OrderPickupAddress').val()},
				function(data) {
					if (data == 'true') {
						Step1.selectedPickUpAddress = $('#OrderPickupAddress').val();
					}
				}
			);
		}

		$('#OrderDropoffAddress').autocomplete({
			// source: '/order/zip_codes/auto',
			source: function( request, response ) {
				var term = request.term;

				$.getJSON("/order/zip_codes/auto", request, function( data, status, xhr ) {
					if (data.length == 1) {
						if (data[0].value == term) {
							return false;
						}

						if (/^\d{5}$/.test(term)) {
							var zipPattern = new RegExp(term + "$");
							if (zipPattern.test(data[0].value)) {
								Step1.selectedDropOffAddress = data[0].value;
								$('#OrderDropoffAddress').val(data[0].value);
								response();
								return false;
							}
						}
					}

					response( data );
				});
			},
			minLength: 2,
			close: function(event, ui) {
				$(this).blur();
				$('#OrderHour').blur();
			},
			select: function(event, ui) {
				Step1.selectedDropOffAddress = ui.item.value;
			}
		}).focus(function () {
			$(this).autocomplete("search");
		});

		// Проверка предустановленного значения при загрузке страницы
		if ($('#OrderDropoffAddress').val()) {
			$.post(
				'/order/zip_codes/check',
				{term: $('#OrderDropoffAddress').val()},
				function(data) {
					if (data == 'true') {
						Step1.selectedDropOffAddress = $('#OrderDropoffAddress').val();
					}
				}
			);
		}

		$('#OrderHour, #OrderMinutes').change(function() {
			if ($('#OrderTo').val() == 4) {
				$('#OrderCharterMinutes option').each(function() {
					if (this.value) {
						var hours = Math.floor(this.value / 60);
						var minutes = this.value % 60;
						var text = '';

						if (hours == 1) {
							text = '1 hour';
						}
						else if (hours > 1) {
							text = hours + ' hours';
						}

						if (minutes > 0) {
							text += ' '+ minutes +' minutes';
						}

						var pickUpHours = $('#OrderHour').val();
						var pickUpMinutes = $('#OrderMinutes').val();

// 						pickUpMinutes = parseInt(pickUpMinutes) + minutes;
// 						if (pickUpMinutes > 59) {
// 							pickUpMinutes -= 60;
// 							pickUpHours += 1;
// 						}

// 						pickUpHours = parseInt(pickUpHours) + hours;
// 						if (pickUpHours > 23) {
// 							pickUpHours -= 24;
// 						}

						var today = new Date();
						var time = new Date(today.getFullYear(), today.getMonth(), today.getDay(), parseInt(pickUpHours) + hours, parseInt(pickUpMinutes) + minutes);

						text += ' ('+ time.toLocaleTimeString().substr(0, 5) +')';

						this.text = text;
					}
				});
			}
		});
	}
};

var loginButtonPress = 'login';
var Login = {
	init: function() {
		$('#UserLoginForm').validate({
			rules: {
				'data[User][email]' : {
					required : true,
					email: true
				},
				'data[User][password]' : {
					required : true
				}
			},
			messages: {
				'data[User][email]' : {
					required : LNG['required'],
					email: LNG['email']
				},
				'data[User][password]' : {
					required : LNG['required']
				}
			}
		});

		$('#UserRegistrationForm').validate({
			rules: {
				'data[User][register_email]' : {
					required : true,
					email: true
				}
			},
			messages: {
				'data[User][register_email]' : {
					required : LNG['required'],
					email: LNG['email']
				}
			}
		});
	}
};

var Step3 = {
	init: function() {
        if (!IS_MOBILE) {
            Step3.initCombobox();
            $('input#OrderAirlines').combobox();
        }

		$('#OrderChildSeat').change(function() {
			if ($('#OrderChildSeat').val() != '0') {
				$('#divChildSeatHint').show('fast');
			}
			else {
				$('#divChildSeatHint').hide('fast');
			}
		});
		$('#OrderChildSeat').change();

		$('#OrderStops').change(function() {
			if ($('#OrderStops').val() != '0') {
				$('#divStopsHint').show('fast');
			}
			else {
				$('#divStopsHint').hide('fast');
			}
		});
		$('#OrderStops').change();

		$('#OrderLuggage').change(function() {
			if ($('#OrderLuggage').is(':checked')) {
				$('#divTextOnBoard').show('fast');
			}
			else {
				$('#divTextOnBoard').hide('fast');
			}
		});
		$('#OrderLuggage').change();

		/// Minimum charter hours
		jQuery.validator.addMethod('phoneNum', function(value, element, params) {
			return /\d{1}.*\d{1}.*\d{1}.*\d{1}.*\d{1}.*\d{1}.*\d{1}.*\d{1}.*\d{1}.*\d{1}/.test(value);
		}, LNG['phoneNum']);

		$('#OrderStep3Form').validate({
			rules: {
				'data[Order][pickup_street]' : {
					required : true,
					minlength: 5
				},
				'data[Order][dropoff_street]' : {
					required : true,
					minlength: 5
				},
				'data[Order][primary_person_traveling]' : 'required',
				'data[Order][phone]' : {
					required: true,
					phoneNum: true
				}
			},
			messages: {
				'data[Order][pickup_street]' : {
					required : LNG['required'],
					minlength: LNG['minimum5chars']
				},
				'data[Order][dropoff_street]' : {
					required : LNG['required'],
					minlength: LNG['minimum5chars']
				},
				'data[Order][primary_person_traveling]' : LNG['required'],
				'data[Order][phone]' : {
					required : LNG['required'],
					phoneNum : LNG['phoneNum']
				}
			}
		});
	},
    initCombobox : function() {
        $.widget("custom.combobox", {
            _create: function () {
                this.wrapper = $("<span>")
                    .addClass("custom-combobox")
                    .insertAfter(this.element);
                this.element.hide();
                this._createAutocomplete();
                this._createShowAllButton();
            },
            _createAutocomplete: function () {
                var selected = this.element.children(":selected"),
                    value = selected.val() ? selected.text() : "";
                this.input = $("<input>")
                    .appendTo(this.wrapper)
                    .val(value)
                    .attr("title", "")
                    .addClass("custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left")
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        //source: $.proxy( this, "_source" )
                            source: Step3.airlines
                    })
                    .tooltip({
                        tooltipClass: "ui-state-highlight"
                    });
                this._on(this.input, {
                    autocompleteselect: function (event, ui) {
                        this.input.val(ui.item.value);
                        this.element.val(ui.item.value);
                    },
                    autocompletechange: "_removeIfInvalid"
                });
            },
            _createShowAllButton: function () {
                var input = this.input,
                    wasOpen = false;
                $("<a>")
                    .attr("tabIndex", -1)
                    .attr("title", "Show All Airlines")
                    .tooltip()
                    .appendTo(this.wrapper)
                    .button({
                        icons: {
                            primary: "ui-icon-triangle-1-s"
                        },
                        text: false
                    })
                    .removeClass("ui-corner-all")
                    .addClass("custom-combobox-toggle ui-corner-right")
                    .mousedown(function () {
                        wasOpen = input.autocomplete("widget").is(":visible");
                    })
                    .click(function () {
                        input.focus();
                        // Close if already visible
                        if (wasOpen) {
                            return;
                        }
                        // Pass empty string as value to search for, displaying all results
                        input.autocomplete( "search", "" );
                    });
            },
            _source: function (request, response) {
                var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                response(this.element.children("option").map(function () {
                    var text = $(this).text();
                    if (this.value && ( !request.term || matcher.test(text) ))
                        return {
                            label: text,
                            value: text,
                            option: this
                        };
                }));
            },
            _removeIfInvalid: function (event, ui) {
                // Selected an item, nothing to do
                if (ui.item) {
                    return;
                }
                // Search for a match (case-insensitive)
                var value = this.input.val(),
                    valueLowerCase = value.toLowerCase(),
                    valid = false;
                this.element.children("option").each(function () {
                    if ($(this).text().toLowerCase() === valueLowerCase) {
                        this.selected = valid = true;
                        return false;
                    }
                });
                // Found a match, nothing to do
                if (valid) {
                    return;
                }

                // Remove invalid value
                //this.input
                //    .val("")
                //    .attr("title", value + " didn't match any item")
                //    .tooltip("open");
                //this.element.val("");
                this._delay(function () {
                    this.input.tooltip("close").attr("title", "");
                }, 2500);
                this.input.autocomplete("instance").term = "";
            },
            _destroy: function () {
                this.wrapper.remove();
                this.element.show();
            }
        });
    },
    airlines: []
};

var Step4 = {
	init: function() {
		$('#divProvoCode').hide();

		$('#aPromoCode').click(function() {
			$('#divProvoCode').show('fast');
			return false;
		});

		$('#divTip').hide();
		$('#divTip2').show();
		$('#aChangeTip').click(function() {
			$('#divTip').show();
			$('#divTip2').hide();

			return false;
		});

		$('#OrderBillingCountry').change(function() {
			/// USA
			if ($('#OrderBillingCountry').val() == 'US') {
				$('#divState').hide();
				$('#divCastate').hide();
				$('#divUsstate').show();
			}
			/// Canada
			else if ($('#OrderBillingCountry').val() == 'CA') {
				$('#divState').hide();
				$('#divCastate').show();
				$('#divUsstate').hide();
			}
			else {
				$('#divState').show();
				$('#divCastate').hide();
				$('#divUsstate').hide();
			}
		});
		$('#OrderBillingCountry').change();

		/// Minimum charter hours
		jQuery.validator.addMethod('notExpired', function(value, element, params) {
			var valueDate = new Date($('#OrderExpirationYear').val(), $('#OrderExpirationMonth').val() - 1, 1);
			var today = new Date();

			return today.getFullYear() != valueDate.getFullYear() || today.getMonth() <= valueDate.getMonth();
		}, LNG['expired']);

		jQuery.validator.addMethod('zipRequired', function(value, element, params) {
			if ($('#OrderBillingCountry').val() == 'US') {
				return /^\d{5}(-\d{4})?$/.test(value);
			}
			else if ($('#OrderBillingCountry').val() == 'CA') {
				value = value.toUpperCase();
				return /^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/.test(value);
			}
			else {
				return true;
			}
		}, LNG['zipRequired']);

		jQuery.validator.addMethod('checked', function(value, element, params) {
			return $(element).is(":checked");
		}, LNG['checked']);

		$('#OrderStep4Form').validate({
			rules: {
				'data[Order][card_number]' : {
					required : true,
					creditcard : true
				},
				'data[Order][expiration_year]' : 'notExpired',
				'data[Order][name_on_card]' : {
					required: true,
					minlength: 5
				},
				'data[Order][billing_street]' : {
					required: true,
					minlength: 5
				},
				'data[Order][billing_city]' : 'required',
// 				'data[Order][billing_state]' :'required',
				'data[Order][billing_zip]' : {
					required : true,
					zipRequired : true
				},
				'data[Order][rule_agree]': {
					checked:true
				},
				'data[Order][email]': {
					required:true,
					email:true
				}
			},
			messages: {
				'data[Order][card_number]' : {
					'required' : LNG['required']
				},
				'data[Order][name_on_card]' : {
					required : LNG['required'],
					minlength: LNG['minimum5chars']
				},
				'data[Order][billing_street]' : {
					required : LNG['required'],
					minlength: LNG['minimum5chars']
				},
				'data[Order][billing_city]' : LNG['required'],
// 				'data[Order][billing_state]' : LNG['required'],
				'data[Order][billing_zip]' : {
					'required' : LNG['required']
				},
				'data[Order][rule_agree]' : {
					'checked' : LNG['needRuleAgree']
				},
				'data[Order][email]': {
					required: LNG['required'],
					email: LNG['required']
				}
			}
		});

		$('#OrderEmail').blur(function() {
			$.post(
				'/order/users/email',
				{email: $('#OrderEmail').val()},
				function(data) {
					if (data == 'exist') {
						$('#btnLogin').show('fast');
					}
					else {
						$('#btnLogin').hide('fast');
					}
				}
			);
		});

		$('#OrderEmail').blur();
	}
};

var Profile = {
	init: function() {
		jQuery.validator.addMethod('confirmRequired', function(value, element, params) {
			if ($('#UserPassword').val() == '') {
				return true;
			}
			else {
				if (value != '') {
					return true;
				}
				else {
					return false;
				}
			}
		}, LNG['confirmRequired']);

		jQuery.validator.addMethod('confirmEq', function(value, element, params) {
			if ($('#UserPassword').val() == '') {
				return true;
			}
			else {
				if (value == $('#UserPassword').val()) {
					return true;
				}
				else {
					return false;
				}
			}
		}, LNG['confirmEq']);

		$('#UserProfileForm').validate({
			rules: {
				'data[User][confirm_password]' : {
					'confirmRequired':true,
					'confirmEq': true
				}
			}
		});

		$('#UserPassword').val('');
	}
}
