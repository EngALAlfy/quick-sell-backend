"use strict";
document.addEventListener('DOMContentLoaded', function () {
    let autosizeDemo = document.querySelector("#autosize-demo");
    let creditCardMask = document.querySelector(".credit-card-mask");
    let phoneNumberMask = document.querySelector(".phone-number-mask");
    let dateMask = document.querySelector(".date-mask");
    let timeMask = document.querySelector(".time-mask");
    let numeralMask = document.querySelector(".numeral-mask");
    let blockMask = document.querySelector(".block-mask");
    let delimiterMask = document.querySelector(".delimiter-mask");
    let customDelimiterMask = document.querySelector(".custom-delimiter-mask");
    let prefixMask = document.querySelector(".prefix-mask");

    if (autosizeDemo) {
        autosize(autosizeDemo);
    }

    if (creditCardMask) {
        new Cleave(creditCardMask, {
            creditCard: true,
            onCreditCardTypeChanged: function (type) {
                let cardTypeElement = document.querySelector(".card-type");
                if (type !== "" && type !== "unknown") {
                    let imgSrc = assetsPath + "img/icons/payments/" + type + "-cc.png";
                    cardTypeElement.innerHTML = '<img src="' + imgSrc + '" height="28"/>';
                } else {
                    cardTypeElement.innerHTML = "";
                }
            }
        });
    }

    if (phoneNumberMask) {
        new Cleave(phoneNumberMask, { phone: true, phoneRegionCode: "US" });
    }

    if (dateMask) {
        new Cleave(dateMask, {
            date: true,
            delimiter: "-",
            datePattern: ["Y", "m", "d"]
        });
    }

    if (timeMask) {
        new Cleave(timeMask, { time: true, timePattern: ["h", "m", "s"] });
    }

    if (numeralMask) {
        new Cleave(numeralMask, { numeral: true, numeralThousandsGroupStyle: "thousand" });
    }

    if (blockMask) {
        new Cleave(blockMask, { blocks: [4, 3, 3], uppercase: true });
    }

    if (delimiterMask) {
        new Cleave(delimiterMask, {
            delimiter: "·",
            blocks: [3, 3, 3],
            uppercase: true
        });
    }

    if (customDelimiterMask) {
        new Cleave(customDelimiterMask, {
            delimiters: [".", ".", "-"],
            blocks: [3, 3, 3, 2],
            uppercase: true
        });
    }

    if (prefixMask) {
        new Cleave(prefixMask, { prefix: "+63", blocks: [3, 3, 3, 4], uppercase: true });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    let maxLengthExamples = document.querySelectorAll(".bootstrap-maxlength-example");
    let formRepeaters = document.querySelectorAll(".form-repeater");

    maxLengthExamples.forEach(function (element) {
        let maxLength = +element.getAttribute("maxlength");
        $(element).maxlength({
            warningClass: "label label-success bg-success text-white",
            limitReachedClass: "label label-danger",
            separator: " out of ",
            preText: "You typed ",
            postText: " chars available.",
            validate: true,
            threshold: maxLength
        });
    });

    formRepeaters.forEach(function (formRepeater) {
        let repeaterCount = 2;
        let innerCount = 1;

        formRepeater.addEventListener("submit", function (e) {
            e.preventDefault();
        });

        $(formRepeater).repeater({
            show: function () {
                let controls = formRepeater.querySelectorAll(".form-control, .form-select");
                let labels = formRepeater.querySelectorAll(".form-label");

                controls.forEach(function (control, index) {
                    let id = "form-repeater-" + repeaterCount + "-" + innerCount;
                    control.setAttribute("id", id);
                    labels[index].setAttribute("for", id);
                    innerCount++;
                });

                repeaterCount++;
                $(formRepeater).slideDown();
            },
            hide: function (complete) {
                if (confirm("Are you sure you want to delete this element?")) {
                    $(formRepeater).slideUp(complete);
                }
            }
        });
    });
});
