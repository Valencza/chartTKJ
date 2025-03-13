"use strict";

class KTCreateAccount {
    constructor() {
        this.e = document.querySelector("#kt_modal_create_account");
        if (this.e) new bootstrap.Modal(this.e);

        this.t = document.querySelector("#kt_create_account_stepper");
        if (this.t) {
            this.i = this.t.querySelector("#kt_create_account_form");
            this.o = this.t.querySelector('[data-kt-stepper-action="submit"]');
            this.a = this.t.querySelector('[data-kt-stepper-action="next"]');
            this.r = new KTStepper(this.t);
            this.s = [];

            this.initStepper();
            this.initValidation();
            this.initEventHandlers();
        }
    }

    initStepper() {
        this.r.on("kt.stepper.changed", (e) => {
            var currentStep = this.r.getCurrentStepIndex();
            if (currentStep === 2) {
                this.o.classList.remove("d-none");
                this.o.classList.add("d-inline-block");
                this.a.classList.add("d-none");
            } else if (currentStep === 3) {
                this.o.classList.add("d-none");
                this.a.classList.add("d-none");
            } else {
                this.o.classList.remove("d-inline-block");
                this.o.classList.remove("d-none");
                this.a.classList.remove("d-none");
            }
        });

        this.r.on("kt.stepper.next", (e) => {
            console.log("stepper.next");
            var validator = this.s[this.r.getCurrentStepIndex() - 1];
            if (validator) {
                validator.validate().then((status) => {
                    console.log("validated!");
                    if (status === "Valid") {
                        this.r.goNext();
                        KTUtil.scrollTop();
                    } else {
                        Swal.fire({
                            text: "Harap isi semua kolom dan tekan submit setelah semua kolom terisi",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, kembali!",
                            customClass: {
                                confirmButton: "btn btn-light"
                            }
                        }).then(() => {
                            KTUtil.scrollTop();
                        });
                    }
                });
            } else {
                this.r.goNext();
                KTUtil.scrollTop();
            }
        });

        this.r.on("kt.stepper.previous", (e) => {
            console.log("stepper.previous");
            this.r.goPrevious();
            KTUtil.scrollTop();
        });
    }

    initValidation() {
        this.s.push(FormValidation.formValidation(this.i, {
            fields: {
                account_type: {
                    validators: {
                        notEmpty: {
                            message: "Account type is required"
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".fv-row",
                    eleInvalidClass: "",
                    eleValidClass: ""
                })
            }
        }));

        this.s.push(FormValidation.formValidation(this.i, {
            fields: {
                no_hp: {
                    validators: {
                        notEmpty: {
                            message: "Harus di isi!"
                        }
                    }
                },
                username: {
                    validators: {
                        notEmpty: {
                            message: "Harus di isi!"
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: "Harus di isi!"
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: "Harus di isi!"
                        }
                    }
                },
                nama_toko: {
                    validators: {
                        notEmpty: {
                            message: "Harus di isi!"
                        }
                    }
                },
                alamat_toko: {
                    validators: {
                        notEmpty: {
                            message: "Harus di isi!"
                        }
                    }
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".fv-row",
                    eleInvalidClass: "",
                    eleValidClass: ""
                })
            }
        }));
    }

    initEventHandlers() {
        this.o.addEventListener("click", (e) => {
            e.preventDefault();
            this.s[1].validate().then((status) => {
                console.log("validated!");
                if (status === "Valid") {
                    this.o.disabled = true;
                    this.o.setAttribute("data-kt-indicator", "on");
                    setTimeout(() => {
                        this.o.removeAttribute("data-kt-indicator");
                        this.o.disabled = false;
                        this.r.goNext();  // Move to step 3
                    }, 2000);
                } else {
                    Swal.fire({
                        text: "Harap isi semua kolom dan tekan submit setelah semua kolom terisi",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, kembali!",
                        customClass: {
                            confirmButton: "btn btn-light"
                        }
                    }).then(() => {
                        KTUtil.scrollTop();
                    });
                }
            });
        });
    }
    
    changeValidator(is_penjahit = false) { 
        // delete old validator
        this.s.splice(1,1);

        // delete all invalid popup message
        document.querySelectorAll('.invalid-feedback').forEach(e => {
            e.remove();
        })
        // set new validator
        if (is_penjahit) {
            this.s.push(FormValidation.formValidation(this.i, {
                fields: {
                    no_hp: {
                        validators: {
                            notEmpty: {
                                message: "Harus di isi!"
                            }
                        }
                    },
                    username: {
                        validators: {
                            notEmpty: {
                                message: "Harus di isi!"
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: "Harus di isi!"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "Harus di isi!"
                            }
                        }
                    },
                    nama_toko: {
                        validators: {
                            notEmpty: {
                                message: "Harus di isi!"
                            }
                        }
                    },
                    alamat_toko: {
                        validators: {
                            notEmpty: {
                                message: "Harus di isi!"
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }));
        } else {
            this.s.push(FormValidation.formValidation(this.i, {
                fields: {
                    no_hp: {
                        validators: {
                            notEmpty: {
                                message: "Harus di isi!"
                            }
                        }
                    },
                    username: {
                        validators: {
                            notEmpty: {
                                message: "Harus di isi!"
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: "Harus di isi!"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "Harus di isi!"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }));
        }
    }
}


document.addEventListener('DOMContentLoaded', function() {
    var KTCreateAccount_handler = new KTCreateAccount();

    var personalRadio = document.getElementById('kt_create_account_form_account_type_personal');
    var corporateRadio = document.getElementById('kt_create_account_form_account_type_corporate');
    var detailAkunPenjahit = document.getElementById('detail-akun-penjahit');

    function toggleDetailSection() {
        if (corporateRadio.checked) {
            KTCreateAccount_handler.changeValidator(true);
            detailAkunPenjahit.style.display = 'block';
        } else {
            KTCreateAccount_handler.changeValidator(false);
            detailAkunPenjahit.style.display = 'none';
        }   
    }

    personalRadio.addEventListener('change', toggleDetailSection);
    corporateRadio.addEventListener('change', toggleDetailSection);

    toggleDetailSection();
});
