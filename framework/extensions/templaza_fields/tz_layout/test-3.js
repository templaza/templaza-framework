var redux = {
    "typography": {
        "typography-body-option": [],
        "typography-menu-option": [],
        "typography-submenu-option": [],
        "typography-h1-option": [],
        "typography-h2-option": [],
        "typography-h3-option": [],
        "typography-h4-option": [],
        "typography-h5-option": [],
        "typography-h6-option": [],
        "typography-top-bar-option": [],
        "typography-footer-option": []
    },
    "required": {
        "preloader-setting": {
            "preloader-animation": [{
                "parent": "preloader-setting",
                "operation": "=",
                "checkValue": "animations"
            }],
            "preloader-fontawesome": [{"parent": "preloader-setting", "operation": "=", "checkValue": "fontawesome"}],
            "preloader-image": [{"parent": "preloader-setting", "operation": "=", "checkValue": "image"}],
            "preloader-color": [{
                "parent": "preloader-setting",
                "operation": "=",
                "checkValue": ["animations", "fontawesome"]
            }],
            "preloader-size": [{
                "parent": "preloader-setting",
                "operation": "=",
                "checkValue": ["animations", "fontawesome"]
            }]
        },
        "preloader": {
            "preloader-setting": [{"parent": "preloader", "operation": "=", "checkValue": "1"}],
            "preloader-bgcolor": [{"parent": "preloader", "operation": "=", "checkValue": "1"}],
            "preloader-size": [{"parent": "preloader", "operation": "=", "checkValue": "1"}]
        },
        "preloader-animation": [],
        "preloader-fontawesome": [],
        "preloader-image": [],
        "preloader-color": [],
        "preloader-bgcolor": [],
        "preloader-size": [],
        "backtotop-icon": [],
        "backtotop": {
            "backtotop-icon": [{"parent": "backtotop", "operation": "=", "checkValue": "1"}],
            "backtotop-icon-size": [{"parent": "backtotop", "operation": "=", "checkValue": "1"}],
            "backtotop-icon-color": [{"parent": "backtotop", "operation": "=", "checkValue": "1"}],
            "backtotop-icon-bgcolor": [{"parent": "backtotop", "operation": "=", "checkValue": "1"}],
            "backtotop-icon-shape": [{"parent": "backtotop", "operation": "=", "checkValue": "1"}],
            "backtotop-on-mobile": [{"parent": "backtotop", "operation": "=", "checkValue": "1"}]
        },
        "backtotop-icon-size": [],
        "backtotop-icon-color": [],
        "backtotop-icon-bgcolor": [],
        "backtotop-icon-shape": [],
        "backtotop-on-mobile": [],
        "layout-background": [],
        "layout-theme": {"layout-background": [{"parent": "layout-theme", "operation": "=", "checkValue": "0"}]},
        "smooth-scroll-speed": [],
        "enable-smooth-scroll": {
            "smooth-scroll-speed": [{
                "parent": "enable-smooth-scroll",
                "operation": "=",
                "checkValue": "1"
            }]
        },
        "header-layout": [],
        "enable-header": {
            "header-layout": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "header-mode": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "header-horizontal-menu-mode": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "header-stacked-menu-mode": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "header-sidebar-menu-mode": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "header-block-1-type": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "header-block-1-custom": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "header-block-2-custom": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "header-menu": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "header-menu-level": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "header-mobile-menu": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "header-mobile-menu-level": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "section-logo": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "logo-type": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "default-logo": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "mobile-logo": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "sidebar-logo": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "logo-text": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "tag-line": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "section-sticky-header": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "sticky-menu-mode": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "sticky-logo": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "sticky-desktop": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "sticky-tablet": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "sticky-mobile": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "section-offcanvas-menu": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "enable-offcanvas": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "offcanvas-direction": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "section-dropdown-animation": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "dropdown-animation-type": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "dropdown-arrow": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
            "dropdown-trigger": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}]
        },
        "header-mode": {
            "header-horizontal-menu-mode": [{"parent": "header-mode", "operation": "=", "checkValue": "horizontal"}],
            "header-stacked-menu-mode": [{"parent": "header-mode", "operation": "=", "checkValue": "stacked"}],
            "header-sidebar-menu-mode": [{"parent": "header-mode", "operation": "=", "checkValue": "sidebar"}],
            "header-absolute": [{"parent": "header-mode", "operation": "!=", "checkValue": "sidebar"}],
            "sidebar-logo": [{"parent": "header-mode", "operation": "=", "checkValue": "sidebar"}],
            "section-sticky-header": [{"parent": "header-mode", "operation": "!=", "checkValue": "sidebar"}],
            "enable-sticky": [{"parent": "header-mode", "operation": "!=", "checkValue": "sidebar"}],
            "section-offcanvas-menu": [{"parent": "header-mode", "operation": "!=", "checkValue": "sidebar"}],
            "section-dropdown-animation": [{"parent": "header-mode", "operation": "!=", "checkValue": "sidebar"}],
            "dropdown-animation-effect": [{"parent": "header-mode", "operation": "!=", "checkValue": "sidebar"}],
            "dropdown-arrow": [{"parent": "header-mode", "operation": "!=", "checkValue": "sidebar"}],
            "dropdown-trigger": [{"parent": "header-mode", "operation": "!=", "checkValue": "sidebar"}]
        },
        "header-horizontal-menu-mode": [],
        "header-stacked-menu-mode": {
            "header-block-2-type": [{
                "parent": "header-stacked-menu-mode",
                "operation": "!=",
                "checkValue": "center"
            }]
        },
        "header-sidebar-menu-mode": [],
        "header-block-1-type": {
            "header-block-1-sidebar": [{
                "parent": "header-block-1-type",
                "operation": "=",
                "checkValue": "sidebar"
            }], "header-block-1-custom": [{"parent": "header-block-1-type", "operation": "=", "checkValue": "custom"}]
        },
        "header-block-1-sidebar": [],
        "header-block-1-custom": [],
        "header-block-2-type": {
            "header-block-2-sidebar": [{
                "parent": "header-block-2-type",
                "operation": "=",
                "checkValue": "sidebar"
            }], "header-block-2-custom": [{"parent": "header-block-2-type", "operation": "=", "checkValue": "custom"}]
        },
        "header-block-2-sidebar": [],
        "header-block-2-custom": [],
        "header-menu": [],
        "header-menu-level": [],
        "header-mobile-menu": [],
        "header-mobile-menu-level": [],
        "header-absolute": [],
        "section-logo": [],
        "logo-type": {
            "default-logo": [{"parent": "logo-type", "operation": "=", "checkValue": "1"}],
            "mobile-logo": [{"parent": "logo-type", "operation": "=", "checkValue": "1"}],
            "logo-text": [{"parent": "logo-type", "operation": "!=", "checkValue": "1"}],
            "tag-line": [{"parent": "logo-type", "operation": "!=", "checkValue": "1"}]
        },
        "default-logo": [],
        "mobile-logo": [],
        "sidebar-logo": [],
        "logo-text": [],
        "tag-line": [],
        "section-sticky-header": [],
        "enable-sticky": {
            "sticky-menu-mode": [{"parent": "enable-sticky", "operation": "=", "checkValue": "1"}],
            "sticky-logo": [{"parent": "enable-sticky", "operation": "=", "checkValue": "1"}],
            "sticky-desktop": [{"parent": "enable-sticky", "operation": "=", "checkValue": "1"}],
            "sticky-tablet": [{"parent": "enable-sticky", "operation": "=", "checkValue": "1"}],
            "sticky-mobile": [{"parent": "enable-sticky", "operation": "=", "checkValue": "1"}]
        },
        "sticky-menu-mode": [],
        "sticky-logo": [],
        "sticky-desktop": [],
        "sticky-tablet": [],
        "sticky-mobile": [],
        "section-offcanvas-menu": [],
        "enable-offcanvas": {
            "offcanvas-sidebar": [{"parent": "enable-offcanvas", "operation": "=", "checkValue": "1"}],
            "offcanvas-togglevisibility": [{"parent": "enable-offcanvas", "operation": "=", "checkValue": "1"}],
            "offcanvas-panelwidth": [{"parent": "enable-offcanvas", "operation": "=", "checkValue": "1"}],
            "offcanvas-animation": [{"parent": "enable-offcanvas", "operation": "=", "checkValue": "1"}],
            "offcanvas-direction": [{"parent": "enable-offcanvas", "operation": "=", "checkValue": "1"}]
        },
        "offcanvas-sidebar": [],
        "offcanvas-togglevisibility": [],
        "offcanvas-panelwidth": [],
        "offcanvas-animation": [],
        "offcanvas-direction": [],
        "section-dropdown-animation": [],
        "dropdown-animation-type": [],
        "dropdown-animation-effect": [],
        "dropdown-arrow": [],
        "dropdown-trigger": [],
        "topsidebar-column-2": [],
        "topsidebar-columns": {
            "topsidebar-column-2": [{
                "parent": "topsidebar-columns",
                "operation": ">",
                "checkValue": "1"
            }],
            "topsidebar-column-3": [{"parent": "topsidebar-columns", "operation": ">", "checkValue": 2}],
            "topsidebar-column-4": [{"parent": "topsidebar-columns", "operation": ">", "checkValue": "3"}],
            "topsidebar-column-5": [{"parent": "topsidebar-columns", "operation": ">", "checkValue": "4"}]
        },
        "topsidebar-column-3": [],
        "topsidebar-column-4": [],
        "topsidebar-column-5": [],
        "typography-body-option": [],
        "typography-body": {
            "typography-body-option": [{
                "parent": "typography-body",
                "operation": "=",
                "checkValue": "custom"
            }]
        },
        "typography-menu-option": [],
        "typography-menu": {
            "typography-menu-option": [{
                "parent": "typography-menu",
                "operation": "=",
                "checkValue": "custom"
            }]
        },
        "typography-submenu-option": [],
        "typography-submenu": {
            "typography-submenu-option": [{
                "parent": "typography-submenu",
                "operation": "=",
                "checkValue": "custom"
            }]
        },
        "typography-h1-option": [],
        "typography-h1": {
            "typography-h1-option": [{
                "parent": "typography-h1",
                "operation": "=",
                "checkValue": "custom"
            }]
        },
        "typography-h2-option": [],
        "typography-h2": {
            "typography-h2-option": [{
                "parent": "typography-h2",
                "operation": "=",
                "checkValue": "custom"
            }]
        },
        "typography-h3-option": [],
        "typography-h3": {
            "typography-h3-option": [{
                "parent": "typography-h3",
                "operation": "=",
                "checkValue": "custom"
            }]
        },
        "typography-h4-option": [],
        "typography-h4": {
            "typography-h4-option": [{
                "parent": "typography-h4",
                "operation": "=",
                "checkValue": "custom"
            }]
        },
        "typography-h5-option": [],
        "typography-h5": {
            "typography-h5-option": [{
                "parent": "typography-h5",
                "operation": "=",
                "checkValue": "custom"
            }]
        },
        "typography-h6-option": [],
        "typography-h6": {
            "typography-h6-option": [{
                "parent": "typography-h6",
                "operation": "=",
                "checkValue": "custom"
            }]
        },
        "typography-top-bar-option": [],
        "typography-top-bar": {
            "typography-top-bar-option": [{
                "parent": "typography-top-bar",
                "operation": "=",
                "checkValue": "custom"
            }]
        },
        "typography-footer-option": [],
        "typography-footer": {
            "typography-footer-option": [{
                "parent": "typography-footer",
                "operation": "=",
                "checkValue": "0"
            }]
        },
        "miscellaneous-logo": [],
        "miscellaneous-development-mode": {
            "miscellaneous-logo": [{
                "parent": "miscellaneous-development-mode",
                "operation": "=",
                "checkValue": "1"
            }],
            "miscellaneous-content": [{
                "parent": "miscellaneous-development-mode",
                "operation": "=",
                "checkValue": "1"
            }],
            "miscellaneous-coming-soon-countdown-date": [{
                "parent": "miscellaneous-development-mode",
                "operation": "=",
                "checkValue": "1"
            }],
            "miscellaneous-coming-soon-social": [{
                "parent": "miscellaneous-development-mode",
                "operation": "=",
                "checkValue": "1"
            }],
            "miscellaneous-background-setting": [{
                "parent": "miscellaneous-development-mode",
                "operation": "=",
                "checkValue": "1"
            }]
        },
        "miscellaneous-content": [],
        "miscellaneous-coming-soon-countdown-date": [],
        "miscellaneous-coming-soon-social": [],
        "miscellaneous-background-setting": [],
        "404-background-color": [],
        "404-background-setting": {
            "404-background-color": [{
                "parent": "404-background-setting",
                "operation": "=",
                "checkValue": "color"
            }],
            "404-background": [{"parent": "404-background-setting", "operation": "=", "checkValue": "image"}],
            "404-background-video": [{"parent": "404-background-setting", "operation": "=", "checkValue": "video"}]
        },
        "404-background": [],
        "404-background-video": [],
        "footer-column-2": [],
        "footer-columns": {
            "footer-column-2": [{"parent": "footer-columns", "operation": ">", "checkValue": "1"}],
            "footer-column-3": [{"parent": "footer-columns", "operation": ">", "checkValue": 2}],
            "footer-column-4": [{"parent": "footer-columns", "operation": ">", "checkValue": "3"}],
            "footer-column-5": [{"parent": "footer-columns", "operation": ">", "checkValue": "4"}]
        },
        "footer-column-3": [],
        "footer-column-4": [],
        "footer-column-5": []
    },
    "fonts": {
        "google": {
            "ABeeZee": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Abel": {"variants": [{"id": "400", "name": "Regular 400"}], "subsets": [{"id": "latin", "name": "Latin"}]},
            "Abhaya Libre": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }, {"id": "sinhala", "name": "Sinhala"}]
            },
            "Abril Fatface": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Aclonica": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Acme": {"variants": [{"id": "400", "name": "Regular 400"}], "subsets": [{"id": "latin", "name": "Latin"}]},
            "Actor": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Adamina": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Advent Pro": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "greek", "name": "Greek"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Aguafina Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Akronim": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Aladin": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Aldrich": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Alef": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "hebrew", "name": "Hebrew"}, {"id": "latin", "name": "Latin"}]
            },
            "Alegreya": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}, {
                    "id": "900",
                    "name": "Black 900"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}, {
                    "id": "800italic",
                    "name": "Extra Bold 800 Italic"
                }, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Alegreya SC": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}, {
                    "id": "900",
                    "name": "Black 900"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}, {
                    "id": "800italic",
                    "name": "Extra Bold 800 Italic"
                }, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Alegreya Sans": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "800", "name": "Extra Bold 800"}, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Alegreya Sans SC": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "800", "name": "Extra Bold 800"}, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Alex Brush": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Alfa Slab One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Alice": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}]
            },
            "Alike": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Alike Angular": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Allan": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Allerta": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Allerta Stencil": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Allura": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Almendra": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Almendra Display": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Almendra SC": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Amarante": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Amaranth": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Amatic SC": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "hebrew", "name": "Hebrew"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Amethysta": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Amiko": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Amiri": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Amita": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Anaheim": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Andada": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Andika": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Angkor": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Annie Use Your Telescope": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Anonymous Pro": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "greek", "name": "Greek"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Antic": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Antic Didone": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Antic Slab": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Anton": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Arapey": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Arbutus": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Arbutus Slab": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Architects Daughter": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Archivo": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Archivo Black": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Archivo Narrow": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Aref Ruqaa": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}]
            },
            "Arima Madurai": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}, {
                    "id": "900",
                    "name": "Black 900"
                }],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "tamil", "name": "Tamil"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Arimo": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "hebrew", "name": "Hebrew"}, {"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "greek", "name": "Greek"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Arizonia": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Armata": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Arsenal": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Artifika": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Arvo": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Arya": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Asap": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Asap Condensed": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Asar": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Asset": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Assistant": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "800", "name": "Extra Bold 800"}],
                "subsets": [{"id": "hebrew", "name": "Hebrew"}, {"id": "latin", "name": "Latin"}]
            },
            "Astloch": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Asul": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Athiti": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {"id": "thai", "name": "Thai"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Atma": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "bengali", "name": "Bengali"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Atomic Age": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Aubrey": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Audiowide": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Autour One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Average": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Average Sans": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Averia Gruesa Libre": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Averia Libre": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Averia Sans Libre": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Averia Serif Libre": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Bad Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}]
            },
            "Bahiana": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Baloo": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Baloo Bhai": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "gujarati",
                    "name": "Gujarati"
                }, {"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Baloo Bhaijaan": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "arabic",
                    "name": "Arabic"
                }, {"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Baloo Bhaina": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "oriya", "name": "Oriya"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Baloo Chettan": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "malayalam",
                    "name": "Malayalam"
                }, {"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Baloo Da": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "bengali", "name": "Bengali"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Baloo Paaji": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "gurmukhi", "name": "Gurmukhi"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Baloo Tamma": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "kannada", "name": "Kannada"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Baloo Tammudu": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "telugu", "name": "Telugu"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Baloo Thambi": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "tamil", "name": "Tamil"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Balthazar": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Bangers": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Barlow": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Barlow Condensed": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Barlow Semi Condensed": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Barrio": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Basic": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Battambang": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Baumans": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Bayon": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Belgrano": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Bellefair": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "hebrew", "name": "Hebrew"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Belleza": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "BenchNine": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Bentham": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Berkshire Swash": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Bevan": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Bigelow Rules": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Bigshot One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Bilbo": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Bilbo Swash Caps": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "BioRhyme": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "BioRhyme Expanded": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Biryani": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "800", "name": "Extra Bold 800"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Bitter": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Black And White Picture": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Black Han Sans": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Black Ops One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Bokor": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Bonbon": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Boogaloo": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Bowlby One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Bowlby One SC": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Brawler": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Bree Serif": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Bubblegum Sans": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Bubbler One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Buda": {"variants": [{"id": "300", "name": "Light 300"}], "subsets": [{"id": "latin", "name": "Latin"}]},
            "Buenard": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Bungee": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Bungee Hairline": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Bungee Inline": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Bungee Outline": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Bungee Shade": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Butcherman": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Butterfly Kids": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Cabin": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Cabin Condensed": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Cabin Sketch": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Caesar Dressing": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Cagliostro": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Cairo": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Calligraffitti": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Cambay": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Cambo": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Candal": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Cantarell": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Cantata One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Cantora One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Capriola": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Cardo": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "greek", "name": "Greek"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Carme": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Carrois Gothic": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Carrois Gothic SC": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Carter One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Catamaran": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "tamil", "name": "Tamil"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Caudex": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "greek", "name": "Greek"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Caveat": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Caveat Brush": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Cedarville Cursive": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Ceviche One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Changa": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Changa One": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Chango": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Chathura": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Chau Philomene One": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Chela One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Chelsea Market": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Chenla": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Cherry Cream Soda": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Cherry Swash": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Chewy": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Chicle": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Chivo": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}, {"id": "900", "name": "Black 900"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Chonburi": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {"id": "thai", "name": "Thai"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Cinzel": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Cinzel Decorative": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "900", "name": "Black 900"}], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Clicker Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Coda": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "800", "name": "Extra Bold 800"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Coda Caption": {
                "variants": [{"id": "800", "name": "Extra Bold 800"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Codystar": {
                "variants": [{"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Coiny": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "tamil", "name": "Tamil"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Combo": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Comfortaa": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "greek", "name": "Greek"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Coming Soon": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Concert One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Condiment": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Content": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Contrail One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Convergence": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Cookie": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Copse": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Corben": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Cormorant": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Cormorant Garamond": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Cormorant Infant": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Cormorant SC": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Cormorant Unicase": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Cormorant Upright": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Courgette": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Cousine": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "hebrew", "name": "Hebrew"}, {"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "greek", "name": "Greek"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Coustard": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Covered By Your Grace": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Crafty Girls": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Creepster": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Crete Round": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Crimson Text": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Croissant One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Crushed": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Cuprum": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Cute Font": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Cutive": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Cutive Mono": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Damion": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Dancing Script": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Dangrek": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "David Libre": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "hebrew", "name": "Hebrew"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Dawning of a New Day": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Days One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Dekko": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Delius": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Delius Swash Caps": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Delius Unicase": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Della Respira": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Denk One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Devonshire": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Dhurjati": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Didact Gothic": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "latin", "name": "Latin"}, {"id": "greek", "name": "Greek"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Diplomata": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Diplomata SC": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Do Hyeon": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Dokdo": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Domine": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Donegal One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Doppio One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Dorsa": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Dosis": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Dr Sugiyama": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Duru Sans": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Dynalight": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "EB Garamond": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Eagle Lake": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "East Sea Dokdo": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Eater": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Economica": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Eczar": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "El Messiri": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }]
            },
            "Electrolize": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Elsie": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Elsie Swash Caps": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Emblema One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Emilys Candy": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Encode Sans": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Encode Sans Condensed": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Encode Sans Expanded": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Encode Sans Semi Condensed": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Encode Sans Semi Expanded": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Engagement": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Englebert": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Enriqueta": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Erica One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Esteban": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Euphoria Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ewert": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Exo": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Exo 2": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Expletus Sans": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Fanwood Text": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Farsan": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "gujarati",
                    "name": "Gujarati"
                }, {"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Fascinate": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Fascinate Inline": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Faster One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Fasthand": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Fauna One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Faustina": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Federant": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Federo": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Felipa": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Fenix": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Finger Paint": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Fira Mono": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "latin", "name": "Latin"}, {"id": "greek", "name": "Greek"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Fira Sans": {
                "variants": [{"id": "100", "name": "Thin 100"}, {"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}, {
                    "id": "900",
                    "name": "Black 900"
                }, {"id": "100italic", "name": "Thin 100 Italic"}, {
                    "id": "200italic",
                    "name": "Extra Light 200 Italic"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}, {
                    "id": "800italic",
                    "name": "Extra Bold 800 Italic"
                }, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Fira Sans Condensed": {
                "variants": [{"id": "100", "name": "Thin 100"}, {"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}, {
                    "id": "900",
                    "name": "Black 900"
                }, {"id": "100italic", "name": "Thin 100 Italic"}, {
                    "id": "200italic",
                    "name": "Extra Light 200 Italic"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}, {
                    "id": "800italic",
                    "name": "Extra Bold 800 Italic"
                }, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Fira Sans Extra Condensed": {
                "variants": [{"id": "100", "name": "Thin 100"}, {"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}, {
                    "id": "900",
                    "name": "Black 900"
                }, {"id": "100italic", "name": "Thin 100 Italic"}, {
                    "id": "200italic",
                    "name": "Extra Light 200 Italic"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}, {
                    "id": "800italic",
                    "name": "Extra Bold 800 Italic"
                }, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Fjalla One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Fjord One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Flamenco": {
                "variants": [{"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Flavors": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Fondamento": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Fontdiner Swanky": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Forum": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Francois One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Frank Ruhl Libre": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "900",
                    "name": "Black 900"
                }],
                "subsets": [{"id": "hebrew", "name": "Hebrew"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Freckle Face": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Fredericka the Great": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Fredoka One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Freehand": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Fresca": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Frijole": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Fruktur": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Fugaz One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "GFS Didot": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "greek", "name": "Greek"}]
            },
            "GFS Neohellenic": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "greek", "name": "Greek"}]
            },
            "Gabriela": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}]
            },
            "Gaegu": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Gafata": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Galada": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "bengali", "name": "Bengali"}, {"id": "latin", "name": "Latin"}]
            },
            "Galdeano": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Galindo": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Gamja Flower": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Gentium Basic": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Gentium Book Basic": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Geo": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Geostar": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Geostar Fill": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Germania One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Gidugu": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Gilda Display": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Give You Glory": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Glass Antiqua": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Glegoo": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Gloria Hallelujah": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Goblin One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Gochi Hand": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Gorditas": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Gothic A1": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Goudy Bookletter 1911": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Graduate": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Grand Hotel": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Gravitas One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Great Vibes": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Griffy": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Gruppo": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Gudea": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Gugi": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Gurajada": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Habibi": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Halant": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Hammersmith One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Hanalei": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Hanalei Fill": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Handlee": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Hanuman": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Happy Monkey": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Harmattan": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}]
            },
            "Headland One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Heebo": {
                "variants": [{"id": "100", "name": "Thin 100"}, {"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "hebrew", "name": "Hebrew"}, {"id": "latin", "name": "Latin"}]
            },
            "Henny Penny": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Herr Von Muellerhoff": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Hi Melody": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Hind": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Hind Guntur": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Hind Madurai": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "tamil", "name": "Tamil"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Hind Siliguri": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "bengali", "name": "Bengali"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Hind Vadodara": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "gujarati", "name": "Gujarati"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Holtwood One SC": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Homemade Apple": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Homenaje": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "IBM Plex Mono": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "IBM Plex Sans": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "IBM Plex Sans Condensed": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "IBM Plex Serif": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "IM Fell DW Pica": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "IM Fell DW Pica SC": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "IM Fell Double Pica": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "IM Fell Double Pica SC": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "IM Fell English": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "IM Fell English SC": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "IM Fell French Canon": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "IM Fell French Canon SC": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "IM Fell Great Primer": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "IM Fell Great Primer SC": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Iceberg": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Iceland": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Imprima": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Inconsolata": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Inder": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Indie Flower": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Inika": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Inknut Antiqua": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "800", "name": "Extra Bold 800"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Irish Grover": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Istok Web": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Italiana": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Italianno": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Itim": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {"id": "thai", "name": "Thai"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Jacques Francois": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Jacques Francois Shadow": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Jaldi": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Jim Nightshade": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Jockey One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Jolly Lodger": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Jomhuria": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Josefin Sans": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "100italic", "name": "Thin 100 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Josefin Slab": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "100italic", "name": "Thin 100 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Joti One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Jua": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Judson": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Julee": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Julius Sans One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Junge": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Jura": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Just Another Hand": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Just Me Again Down Here": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Kadwa": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {"id": "latin", "name": "Latin"}]
            },
            "Kalam": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Kameron": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Kanit": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {"id": "thai", "name": "Thai"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Kantumruy": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}], "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Karla": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Karma": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Katibeh": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Kaushan Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Kavivanar": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "tamil", "name": "Tamil"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Kavoon": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Kdam Thmor": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Keania One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Kelly Slab": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Kenia": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Khand": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Khmer": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Khula": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Kirang Haerang": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Kite One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Knewave": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Kotta One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Koulen": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Kranky": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Kreon": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Kristi": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Krona One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Kumar One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "gujarati", "name": "Gujarati"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Kumar One Outline": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "gujarati", "name": "Gujarati"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Kurale": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "devanagari",
                    "name": "Devanagari"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "La Belle Aurore": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Laila": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Lakki Reddy": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Lalezar": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "arabic",
                    "name": "Arabic"
                }, {"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Lancelot": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Lateef": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}]
            },
            "Lato": {
                "variants": [{"id": "100", "name": "Thin 100"}, {"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "League Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Leckerli One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Ledger": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Lekton": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Lemon": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Lemonada": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "arabic",
                    "name": "Arabic"
                }, {"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Libre Barcode 128": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Libre Barcode 128 Text": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Libre Barcode 39": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Libre Barcode 39 Extended": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Libre Barcode 39 Extended Text": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Libre Barcode 39 Text": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Libre Baskerville": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Libre Franklin": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Life Savers": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Lilita One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Lily Script One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Limelight": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Linden Hill": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Lobster": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Lobster Two": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Londrina Outline": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Londrina Shadow": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Londrina Sketch": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Londrina Solid": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Lora": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Love Ya Like A Sister": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Loved by the King": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Lovers Quarrel": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Luckiest Guy": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Lusitana": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Lustria": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Macondo": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Macondo Swash Caps": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Mada": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}]
            },
            "Magra": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Maiden Orange": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Maitree": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {"id": "thai", "name": "Thai"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Mako": {"variants": [{"id": "400", "name": "Regular 400"}], "subsets": [{"id": "latin", "name": "Latin"}]},
            "Mallanna": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Mandali": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Manuale": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Marcellus": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Marcellus SC": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Marck Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Margarine": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Markazi Text": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "arabic",
                    "name": "Arabic"
                }, {"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Marko One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Marmelad": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Martel": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "800", "name": "Extra Bold 800"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Martel Sans": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "800", "name": "Extra Bold 800"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Marvel": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Mate": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Mate SC": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Maven Pro": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "700", "name": "Bold 700"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "McLaren": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Meddon": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "MedievalSharp": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Medula One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Meera Inimai": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "tamil", "name": "Tamil"}]
            },
            "Megrim": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Meie Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Merienda": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Merienda One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Merriweather": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}, {"id": "900", "name": "Black 900"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Merriweather Sans": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Metal": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Metal Mania": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Metamorphous": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Metrophobic": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Michroma": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Milonga": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Miltonian": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Miltonian Tattoo": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Mina": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "bengali", "name": "Bengali"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Miniver": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Miriam Libre": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "hebrew", "name": "Hebrew"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Mirza": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Miss Fajardose": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Mitr": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {"id": "thai", "name": "Thai"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Modak": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Modern Antiqua": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Mogra": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "gujarati", "name": "Gujarati"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Molengo": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Molle": {
                "variants": [{"id": "400italic", "name": "Regular 400 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Monda": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Monofett": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Monoton": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Monsieur La Doulaise": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Montaga": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Montez": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Montserrat": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Montserrat Alternates": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Montserrat Subrayada": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Moul": {"variants": [{"id": "400", "name": "Regular 400"}], "subsets": [{"id": "khmer", "name": "Khmer"}]},
            "Moulpali": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Mountains of Christmas": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Mouse Memoirs": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Mr Bedfort": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Mr Dafoe": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Mr De Haviland": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Mrs Saint Delafield": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Mrs Sheppards": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Mukta": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Mukta Mahee": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}],
                "subsets": [{"id": "gurmukhi", "name": "Gurmukhi"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Mukta Malar": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "tamil", "name": "Tamil"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Mukta Vaani": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}],
                "subsets": [{"id": "gujarati", "name": "Gujarati"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Muli": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "800", "name": "Extra Bold 800"}, {"id": "900", "name": "Black 900"}, {
                    "id": "200italic",
                    "name": "Extra Light 200 Italic"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Mystery Quest": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "NTR": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Nanum Brush Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Nanum Gothic": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "800", "name": "Extra Bold 800"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Nanum Gothic Coding": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }], "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Nanum Myeongjo": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "800", "name": "Extra Bold 800"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Nanum Pen Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Neucha": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}]
            },
            "Neuton": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "400italic", "name": "Regular 400 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "New Rocker": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "News Cycle": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Niconne": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Nixie One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Nobile": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "700", "name": "Bold 700"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Nokora": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Norican": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Nosifer": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Nothing You Could Do": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Noticia Text": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Noto Sans": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "devanagari", "name": "Devanagari"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "greek", "name": "Greek"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Noto Serif": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Nova Cut": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Nova Flat": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Nova Mono": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "greek", "name": "Greek"}]
            },
            "Nova Oval": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Nova Round": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Nova Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Nova Slim": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Nova Square": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Numans": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Nunito": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "800", "name": "Extra Bold 800"}, {"id": "900", "name": "Black 900"}, {
                    "id": "200italic",
                    "name": "Extra Light 200 Italic"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Nunito Sans": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "800", "name": "Extra Bold 800"}, {"id": "900", "name": "Black 900"}, {
                    "id": "200italic",
                    "name": "Extra Light 200 Italic"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Odor Mean Chey": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Offside": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Old Standard TT": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Oldenburg": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Oleo Script": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Oleo Script Swash Caps": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Open Sans": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Open Sans Condensed": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "300italic", "name": "Light 300 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Oranienbaum": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Orbitron": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "700", "name": "Bold 700"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Oregano": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Orienta": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Original Surfer": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Oswald": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Over the Rainbow": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Overlock": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Overlock SC": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Overpass": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}, {
                    "id": "900",
                    "name": "Black 900"
                }, {"id": "100italic", "name": "Thin 100 Italic"}, {
                    "id": "200italic",
                    "name": "Extra Light 200 Italic"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Overpass Mono": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ovo": {"variants": [{"id": "400", "name": "Regular 400"}], "subsets": [{"id": "latin", "name": "Latin"}]},
            "Oxygen": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Oxygen Mono": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "PT Mono": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "PT Sans": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "PT Sans Caption": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "PT Sans Narrow": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "PT Serif": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "PT Serif Caption": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Pacifico": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Padauk": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "myanmar", "name": "Myanmar"}, {"id": "latin", "name": "Latin"}]
            },
            "Palanquin": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Palanquin Dark": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Pangolin": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Paprika": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Parisienne": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Passero One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Passion One": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Pathway Gothic One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Patrick Hand": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Patrick Hand SC": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Pattaya": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {"id": "thai", "name": "Thai"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Patua One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Pavanam": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "tamil", "name": "Tamil"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Paytone One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Peddana": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Peralta": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Permanent Marker": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Petit Formal Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Petrona": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Philosopher": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}]
            },
            "Piedra": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Pinyon Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Pirata One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Plaster": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Play": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "greek", "name": "Greek"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Playball": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Playfair Display": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Playfair Display SC": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Podkova": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Poiret One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Poller One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Poly": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Pompiere": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Pontano Sans": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Poor Story": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Poppins": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Port Lligat Sans": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Port Lligat Slab": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Pragati Narrow": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Prata": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}]
            },
            "Preahvihear": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Press Start 2P": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "greek", "name": "Greek"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Pridi": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {"id": "thai", "name": "Thai"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Princess Sofia": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Prociono": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Prompt": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {"id": "thai", "name": "Thai"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Prosto One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Proza Libre": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Puritan": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Purple Purse": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Quando": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Quantico": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Quattrocento": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Quattrocento Sans": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Questrial": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Quicksand": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Quintessential": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Qwigley": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Racing Sans One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Radley": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rajdhani": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rakkas": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Raleway": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Raleway Dots": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ramabhadra": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Ramaraja": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Rambla": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rammetto One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ranchers": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rancho": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Ranga": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rasa": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "gujarati", "name": "Gujarati"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rationale": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Ravi Prakash": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Redressed": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Reem Kufi": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}]
            },
            "Reenie Beanie": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Revalia": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rhodium Libre": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ribeye": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ribeye Marrow": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Righteous": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Risque": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Roboto": {
                "variants": [{"id": "100", "name": "Thin 100"}, {"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "900",
                    "name": "Black 900"
                }, {"id": "100italic", "name": "Thin 100 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Roboto Condensed": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "700", "name": "Bold 700"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Roboto Mono": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "100italic", "name": "Thin 100 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Roboto Slab": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rochester": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Rock Salt": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Rokkitt": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Romanesco": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ropa Sans": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rosario": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Rosarivo": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rouge Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Rozha One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rubik": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "900",
                    "name": "Black 900"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "hebrew", "name": "Hebrew"}, {"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rubik Mono One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ruda": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "900",
                    "name": "Black 900"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rufina": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ruge Boogie": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ruluko": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rum Raisin": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ruslan Display": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Russo One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ruthie": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Rye": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Sacramento": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Sahitya": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {"id": "latin", "name": "Latin"}]
            },
            "Sail": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Saira": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Saira Condensed": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Saira Extra Condensed": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Saira Semi Condensed": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Salsa": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Sanchez": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Sancreek": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Sansita": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "800", "name": "Extra Bold 800"}, {"id": "900", "name": "Black 900"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}, {
                    "id": "800italic",
                    "name": "Extra Bold 800 Italic"
                }, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Sarala": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Sarina": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Sarpanch": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Satisfy": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Scada": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Scheherazade": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}]
            },
            "Schoolbell": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Scope One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Seaweed Script": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Secular One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "hebrew", "name": "Hebrew"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Sedgwick Ave": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Sedgwick Ave Display": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Sevillana": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Seymour One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Shadows Into Light": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Shadows Into Light Two": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Shanti": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Share": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Share Tech": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Share Tech Mono": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Shojumaru": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Short Stack": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Shrikhand": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "gujarati", "name": "Gujarati"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Siemreap": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Sigmar One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Signika": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Signika Negative": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Simonetta": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "900",
                    "name": "Black 900"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Sintony": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Sirin Stencil": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Six Caps": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Skranji": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Slabo 13px": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Slabo 27px": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Slackey": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Smokum": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Smythe": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Sniglet": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "800", "name": "Extra Bold 800"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Snippet": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Snowburst One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Sofadi One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Sofia": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Song Myung": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Sonsie One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Sorts Mill Goudy": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Source Code Pro": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Source Sans Pro": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "200italic",
                    "name": "Extra Light 200 Italic"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "vietnamese", "name": "Vietnamese"}, {"id": "latin", "name": "Latin"}, {
                    "id": "greek",
                    "name": "Greek"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Source Serif Pro": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Space Mono": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Special Elite": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Spectral": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}, {
                    "id": "200italic",
                    "name": "Extra Light 200 Italic"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}, {
                    "id": "800italic",
                    "name": "Extra Bold 800 Italic"
                }],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Spectral SC": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "800", "name": "Extra Bold 800"}, {
                    "id": "200italic",
                    "name": "Extra Light 200 Italic"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}, {
                    "id": "800italic",
                    "name": "Extra Bold 800 Italic"
                }],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Spicy Rice": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Spinnaker": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Spirax": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Squada One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Sree Krushnadevaraya": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Sriracha": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {"id": "thai", "name": "Thai"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Stalemate": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Stalinist One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Stardos Stencil": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Stint Ultra Condensed": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Stint Ultra Expanded": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Stoke": {
                "variants": [{"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Strait": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Stylish": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Sue Ellen Francisco": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Suez One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "hebrew", "name": "Hebrew"}, {"id": "latin", "name": "Latin"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Sumana": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Sunflower": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Sunshiney": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Supermercado One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Sura": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Suranna": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Suravaram": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Suwannaphum": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Swanky and Moo Moo": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Syncopate": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Tajawal": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "800", "name": "Extra Bold 800"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "arabic", "name": "Arabic"}, {"id": "latin", "name": "Latin"}]
            },
            "Tangerine": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Taprom": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "khmer", "name": "Khmer"}]
            },
            "Tauri": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Taviraj": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {"id": "thai", "name": "Thai"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Teko": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Telex": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Tenali Ramakrishna": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Tenor Sans": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Text Me One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "The Girl Next Door": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Tienne": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "900", "name": "Black 900"}], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Tillana": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Timmana": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "telugu", "name": "Telugu"}]
            },
            "Tinos": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "hebrew", "name": "Hebrew"}, {"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "greek", "name": "Greek"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Titan One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Titillium Web": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "200italic",
                    "name": "Extra Light 200 Italic"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Trade Winds": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Trirong": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}, {
                    "id": "100italic",
                    "name": "Thin 100 Italic"
                }, {"id": "200italic", "name": "Extra Light 200 Italic"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "800italic", "name": "Extra Bold 800 Italic"}, {
                    "id": "900italic",
                    "name": "Black 900 Italic"
                }],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {"id": "thai", "name": "Thai"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Trocchi": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Trochut": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}], "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Trykker": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Tulpen One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Ubuntu": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "300italic",
                    "name": "Light 300 Italic"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {
                    "id": "500italic",
                    "name": "Medium 500 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "latin", "name": "Latin"}, {"id": "greek", "name": "Greek"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ubuntu Condensed": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "latin", "name": "Latin"}, {"id": "greek", "name": "Greek"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ubuntu Mono": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "greek-ext", "name": "Greek Extended"}, {
                    "id": "cyrillic-ext",
                    "name": "Cyrillic Extended"
                }, {"id": "latin", "name": "Latin"}, {"id": "greek", "name": "Greek"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Ultra": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Uncial Antiqua": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Underdog": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Unica One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "UnifrakturCook": {
                "variants": [{"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "UnifrakturMaguntia": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Unkempt": {
                "variants": [{"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Unlock": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Unna": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "VT323": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Vampiro One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Varela": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Varela Round": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "hebrew", "name": "Hebrew"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Vast Shadow": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Vesper Libre": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "700", "name": "Bold 700"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Vibur": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Vidaloka": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Viga": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Voces": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Volkhov": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "400italic", "name": "Regular 400 Italic"}, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Vollkorn": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "900", "name": "Black 900"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "600italic", "name": "Semi-Bold 600 Italic"}, {
                    "id": "700italic",
                    "name": "Bold 700 Italic"
                }, {"id": "900italic", "name": "Black 900 Italic"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "greek", "name": "Greek"}, {
                    "id": "cyrillic",
                    "name": "Cyrillic"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Vollkorn SC": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "600",
                    "name": "Semi-Bold 600"
                }, {"id": "700", "name": "Bold 700"}, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Voltaire": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Waiting for the Sunrise": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Wallpoet": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Walter Turncoat": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Warnes": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Wellfleet": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Wendy One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Wire One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Work Sans": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "200",
                    "name": "Extra Light 200"
                }, {"id": "300", "name": "Light 300"}, {"id": "400", "name": "Regular 400"}, {
                    "id": "500",
                    "name": "Medium 500"
                }, {"id": "600", "name": "Semi-Bold 600"}, {"id": "700", "name": "Bold 700"}, {
                    "id": "800",
                    "name": "Extra Bold 800"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Yanone Kaffeesatz": {
                "variants": [{"id": "200", "name": "Extra Light 200"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "700", "name": "Bold 700"}],
                "subsets": [{"id": "vietnamese", "name": "Vietnamese"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "cyrillic", "name": "Cyrillic"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Yantramanav": {
                "variants": [{"id": "100", "name": "Thin 100"}, {
                    "id": "300",
                    "name": "Light 300"
                }, {"id": "400", "name": "Regular 400"}, {"id": "500", "name": "Medium 500"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "900", "name": "Black 900"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Yatra One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "devanagari", "name": "Devanagari"}, {
                    "id": "latin",
                    "name": "Latin"
                }, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Yellowtail": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Yeon Sung": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "korean", "name": "Korean"}, {"id": "latin", "name": "Latin"}]
            },
            "Yeseva One": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "cyrillic-ext", "name": "Cyrillic Extended"}, {
                    "id": "vietnamese",
                    "name": "Vietnamese"
                }, {"id": "latin", "name": "Latin"}, {"id": "cyrillic", "name": "Cyrillic"}, {
                    "id": "latin-ext",
                    "name": "Latin Extended"
                }]
            },
            "Yesteryear": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Yrsa": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Zeyada": {
                "variants": [{"id": "400", "name": "Regular 400"}],
                "subsets": [{"id": "latin", "name": "Latin"}]
            },
            "Zilla Slab": {
                "variants": [{"id": "300", "name": "Light 300"}, {
                    "id": "400",
                    "name": "Regular 400"
                }, {"id": "500", "name": "Medium 500"}, {"id": "600", "name": "Semi-Bold 600"}, {
                    "id": "700",
                    "name": "Bold 700"
                }, {"id": "300italic", "name": "Light 300 Italic"}, {
                    "id": "400italic",
                    "name": "Regular 400 Italic"
                }, {"id": "500italic", "name": "Medium 500 Italic"}, {
                    "id": "600italic",
                    "name": "Semi-Bold 600 Italic"
                }, {"id": "700italic", "name": "Bold 700 Italic"}],
                "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            },
            "Zilla Slab Highlight": {
                "variants": [{"id": "400", "name": "Regular 400"}, {
                    "id": "700",
                    "name": "Bold 700"
                }], "subsets": [{"id": "latin", "name": "Latin"}, {"id": "latin-ext", "name": "Latin Extended"}]
            }
        }
    },
    "required_child": {
        "preloader-setting": [{"parent": "preloader", "operation": "=", "checkValue": "1"}],
        "preloader-animation": [{"parent": "preloader-setting", "operation": "=", "checkValue": "animations"}],
        "preloader-fontawesome": [{"parent": "preloader-setting", "operation": "=", "checkValue": "fontawesome"}],
        "preloader-image": [{"parent": "preloader-setting", "operation": "=", "checkValue": "image"}],
        "preloader-color": [{
            "parent": "preloader-setting",
            "operation": "=",
            "checkValue": ["animations", "fontawesome"]
        }],
        "preloader-bgcolor": [{"parent": "preloader", "operation": "=", "checkValue": "1"}],
        "preloader-size": [{"parent": "preloader", "operation": "=", "checkValue": "1"}, {
            "parent": "preloader-setting",
            "operation": "=",
            "checkValue": ["animations", "fontawesome"]
        }],
        "backtotop-icon": [{"parent": "backtotop", "operation": "=", "checkValue": "1"}],
        "backtotop-icon-size": [{"parent": "backtotop", "operation": "=", "checkValue": "1"}],
        "backtotop-icon-color": [{"parent": "backtotop", "operation": "=", "checkValue": "1"}],
        "backtotop-icon-bgcolor": [{"parent": "backtotop", "operation": "=", "checkValue": "1"}],
        "backtotop-icon-shape": [{"parent": "backtotop", "operation": "=", "checkValue": "1"}],
        "backtotop-on-mobile": [{"parent": "backtotop", "operation": "=", "checkValue": "1"}],
        "layout-background": [{"parent": "layout-theme", "operation": "=", "checkValue": "0"}],
        "smooth-scroll-speed": [{"parent": "enable-smooth-scroll", "operation": "=", "checkValue": "1"}],
        "header-layout": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
        "header-mode": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
        "header-horizontal-menu-mode": [{
            "parent": "enable-header",
            "operation": "=",
            "checkValue": "1"
        }, {"parent": "header-mode", "operation": "=", "checkValue": "horizontal"}],
        "header-stacked-menu-mode": [{
            "parent": "enable-header",
            "operation": "=",
            "checkValue": "1"
        }, {"parent": "header-mode", "operation": "=", "checkValue": "stacked"}],
        "header-sidebar-menu-mode": [{
            "parent": "enable-header",
            "operation": "=",
            "checkValue": "1"
        }, {"parent": "header-mode", "operation": "=", "checkValue": "sidebar"}],
        "header-block-1-type": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
        "header-block-1-sidebar": [{"parent": "header-block-1-type", "operation": "=", "checkValue": "sidebar"}],
        "header-block-1-custom": [{
            "parent": "enable-header",
            "operation": "=",
            "checkValue": "1"
        }, {"parent": "header-block-1-type", "operation": "=", "checkValue": "custom"}],
        "header-block-2-type": [{"parent": "header-stacked-menu-mode", "operation": "!=", "checkValue": "center"}],
        "header-block-2-sidebar": [{"parent": "header-block-2-type", "operation": "=", "checkValue": "sidebar"}],
        "header-block-2-custom": [{
            "parent": "enable-header",
            "operation": "=",
            "checkValue": "1"
        }, {"parent": "header-block-2-type", "operation": "=", "checkValue": "custom"}],
        "header-menu": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
        "header-menu-level": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
        "header-mobile-menu": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
        "header-mobile-menu-level": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
        "header-absolute": [{"parent": "header-mode", "operation": "!=", "checkValue": "sidebar"}],
        "section-logo": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
        "logo-type": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
        "default-logo": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}, {
            "parent": "logo-type",
            "operation": "=",
            "checkValue": "1"
        }],
        "mobile-logo": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}, {
            "parent": "logo-type",
            "operation": "=",
            "checkValue": "1"
        }],
        "sidebar-logo": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}, {
            "parent": "header-mode",
            "operation": "=",
            "checkValue": "sidebar"
        }],
        "logo-text": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}, {
            "parent": "logo-type",
            "operation": "!=",
            "checkValue": "1"
        }],
        "tag-line": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}, {
            "parent": "logo-type",
            "operation": "!=",
            "checkValue": "1"
        }],
        "section-sticky-header": [{
            "parent": "enable-header",
            "operation": "=",
            "checkValue": "1"
        }, {"parent": "header-mode", "operation": "!=", "checkValue": "sidebar"}],
        "enable-sticky": [{"parent": "header-mode", "operation": "!=", "checkValue": "sidebar"}],
        "sticky-menu-mode": [{
            "parent": "enable-header",
            "operation": "=",
            "checkValue": "1"
        }, {"parent": "enable-sticky", "operation": "=", "checkValue": "1"}],
        "sticky-logo": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}, {
            "parent": "enable-sticky",
            "operation": "=",
            "checkValue": "1"
        }],
        "sticky-desktop": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}, {
            "parent": "enable-sticky",
            "operation": "=",
            "checkValue": "1"
        }],
        "sticky-tablet": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}, {
            "parent": "enable-sticky",
            "operation": "=",
            "checkValue": "1"
        }],
        "sticky-mobile": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}, {
            "parent": "enable-sticky",
            "operation": "=",
            "checkValue": "1"
        }],
        "section-offcanvas-menu": [{
            "parent": "enable-header",
            "operation": "=",
            "checkValue": "1"
        }, {"parent": "header-mode", "operation": "!=", "checkValue": "sidebar"}],
        "enable-offcanvas": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
        "offcanvas-sidebar": [{"parent": "enable-offcanvas", "operation": "=", "checkValue": "1"}],
        "offcanvas-togglevisibility": [{"parent": "enable-offcanvas", "operation": "=", "checkValue": "1"}],
        "offcanvas-panelwidth": [{"parent": "enable-offcanvas", "operation": "=", "checkValue": "1"}],
        "offcanvas-animation": [{"parent": "enable-offcanvas", "operation": "=", "checkValue": "1"}],
        "offcanvas-direction": [{
            "parent": "enable-header",
            "operation": "=",
            "checkValue": "1"
        }, {"parent": "enable-offcanvas", "operation": "=", "checkValue": "1"}],
        "section-dropdown-animation": [{
            "parent": "enable-header",
            "operation": "=",
            "checkValue": "1"
        }, {"parent": "header-mode", "operation": "!=", "checkValue": "sidebar"}],
        "dropdown-animation-type": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}],
        "dropdown-animation-effect": [{"parent": "header-mode", "operation": "!=", "checkValue": "sidebar"}],
        "dropdown-arrow": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}, {
            "parent": "header-mode",
            "operation": "!=",
            "checkValue": "sidebar"
        }],
        "dropdown-trigger": [{"parent": "enable-header", "operation": "=", "checkValue": "1"}, {
            "parent": "header-mode",
            "operation": "!=",
            "checkValue": "sidebar"
        }],
        "topsidebar-column-2": [{"parent": "topsidebar-columns", "operation": ">", "checkValue": "1"}],
        "topsidebar-column-3": [{"parent": "topsidebar-columns", "operation": ">", "checkValue": 2}],
        "topsidebar-column-4": [{"parent": "topsidebar-columns", "operation": ">", "checkValue": "3"}],
        "topsidebar-column-5": [{"parent": "topsidebar-columns", "operation": ">", "checkValue": "4"}],
        "typography-body-option": [{"parent": "typography-body", "operation": "=", "checkValue": "custom"}],
        "typography-menu-option": [{"parent": "typography-menu", "operation": "=", "checkValue": "custom"}],
        "typography-submenu-option": [{"parent": "typography-submenu", "operation": "=", "checkValue": "custom"}],
        "typography-h1-option": [{"parent": "typography-h1", "operation": "=", "checkValue": "custom"}],
        "typography-h2-option": [{"parent": "typography-h2", "operation": "=", "checkValue": "custom"}],
        "typography-h3-option": [{"parent": "typography-h3", "operation": "=", "checkValue": "custom"}],
        "typography-h4-option": [{"parent": "typography-h4", "operation": "=", "checkValue": "custom"}],
        "typography-h5-option": [{"parent": "typography-h5", "operation": "=", "checkValue": "custom"}],
        "typography-h6-option": [{"parent": "typography-h6", "operation": "=", "checkValue": "custom"}],
        "typography-top-bar-option": [{"parent": "typography-top-bar", "operation": "=", "checkValue": "custom"}],
        "typography-footer-option": [{"parent": "typography-footer", "operation": "=", "checkValue": "0"}],
        "miscellaneous-logo": [{"parent": "miscellaneous-development-mode", "operation": "=", "checkValue": "1"}],
        "miscellaneous-content": [{"parent": "miscellaneous-development-mode", "operation": "=", "checkValue": "1"}],
        "miscellaneous-coming-soon-countdown-date": [{
            "parent": "miscellaneous-development-mode",
            "operation": "=",
            "checkValue": "1"
        }],
        "miscellaneous-coming-soon-social": [{
            "parent": "miscellaneous-development-mode",
            "operation": "=",
            "checkValue": "1"
        }],
        "miscellaneous-background-setting": [{
            "parent": "miscellaneous-development-mode",
            "operation": "=",
            "checkValue": "1"
        }],
        "404-background-color": [{"parent": "404-background-setting", "operation": "=", "checkValue": "color"}],
        "404-background": [{"parent": "404-background-setting", "operation": "=", "checkValue": "image"}],
        "404-background-video": [{"parent": "404-background-setting", "operation": "=", "checkValue": "video"}],
        "footer-column-2": [{"parent": "footer-columns", "operation": ">", "checkValue": "1"}],
        "footer-column-3": [{"parent": "footer-columns", "operation": ">", "checkValue": 2}],
        "footer-column-4": [{"parent": "footer-columns", "operation": ">", "checkValue": "3"}],
        "footer-column-5": [{"parent": "footer-columns", "operation": ">", "checkValue": "4"}]
    },
    "fields": {
        "switch": {
            "preloader": 1,
            "backtotop": 1,
            "backtotop-on-mobile": 1,
            "enable-smooth-scroll": 1,
            "enable-header": 1,
            "header-absolute": 1,
            "logo-type": 1,
            "enable-sticky": 1,
            "enable-offcanvas": 1,
            "offcanvas-direction": 1,
            "dropdown-arrow": 1,
            "dropdown-trigger": 1,
            "miscellaneous-development-mode": 1,
            "miscellaneous-coming-soon-social": 1
        },
        "button_set": {
            "preloader-setting": 1,
            "layout-theme": 1,
            "header-layout": 1,
            "dropdown-animation-type": 1,
            "topsidebar-layout": 1,
            "typography-body": 1,
            "typography-menu": 1,
            "typography-submenu": 1,
            "typography-h1": 1,
            "typography-h2": 1,
            "typography-h3": 1,
            "typography-h4": 1,
            "typography-h5": 1,
            "typography-h6": 1,
            "typography-top-bar": 1,
            "typography-footer": 1,
            "404-background-setting": 1,
            "footer-layout": 1
        },
        "tz_preloader": {"preloader-animation": 1},
        "text": {
            "preloader-fontawesome": 1,
            "logo-text": 1,
            "tag-line": 1,
            "offcanvas-panelwidth": 1,
            "miscellaneous-coming-soon-countdown-date": 1,
            "404-call-to-action": 1,
            "topsidebar-column-1-custom_class": 1,
            "topsidebar-column-2-custom_class": 1,
            "topsidebar-column-3-custom_class": 1,
            "topsidebar-column-4-custom_class": 1,
            "topsidebar-column-5-custom_class": 1,
            "footer-column-1-custom_class": 1,
            "footer-column-2-custom_class": 1,
            "footer-column-3-custom_class": 1,
            "footer-column-4-custom_class": 1,
            "footer-column-5-custom_class": 1
        },
        "background": {"preloader-image": 1, "layout-background": 1, "404-background": 1},
        "color_rgba": {
            "preloader-color": 1,
            "preloader-bgcolor": 1,
            "backtotop-icon-color": 1,
            "backtotop-icon-bgcolor": 1,
            "body-background-color": 1,
            "body-text-color": 1,
            "body-heading-color": 1,
            "body-link-color": 1,
            "body-link-hover-color": 1,
            "header-bg": 1,
            "header-text-color": 1,
            "header-heading-color": 1,
            "header-link-color": 1,
            "header-link-hover-color": 1,
            "header-logo-text-color": 1,
            "header-logo-text-tagline-color": 1,
            "topbar-bordercolor": 1,
            "main-menu-link-color": 1,
            "main-menu-link-active-color": 1,
            "main-menu-link-hover-color": 1,
            "sidebar-separate-color": 1,
            "sticky-header-background-color": 1,
            "sticky-menu-link-color": 1,
            "sticky-menu-link-active-color": 1,
            "sticky-menu-link-hover-color": 1,
            "sticky-off-canvas-button-color": 1,
            "dropdown-menu-background-color": 1,
            "dropdown-menu-link-color": 1,
            "dropdown-menu-link-active-color": 1,
            "dropdown-menu-active-bg-color": 1,
            "dropdown-menu-link-hover-color": 1,
            "dropdown-menu-hover-bg-color": 1,
            "dropdown-menu-megamenu-border-color": 1,
            "off-canvas-button-color-close": 1,
            "off-canvas-background-color": 1,
            "off-canvas-mobile-menu-text-color": 1,
            "off-canvas-mobile-menu-link-color": 1,
            "off-canvas-button-color": 1,
            "off-canvas-link-active-color": 1,
            "off-canvas-mobile-menu-active-bg-color": 1,
            "404-background-color": 1
        },
        "slider": {
            "preloader-size": 1,
            "backtotop-icon-size": 1,
            "smooth-scroll-speed": 1,
            "topsidebar-column-1-width": 1,
            "topsidebar-column-2-width": 1,
            "topsidebar-column-3-width": 1,
            "topsidebar-column-4-width": 1,
            "topsidebar-column-5-width": 1,
            "footer-column-1-width": 1,
            "footer-column-2-width": 1,
            "footer-column-3-width": 1,
            "footer-column-4-width": 1,
            "footer-column-5-width": 1
        },
        "select": {
            "backtotop-icon": 1,
            "backtotop-icon-shape": 1,
            "header-block-1-type": 1,
            "header-block-1-sidebar": 1,
            "header-block-2-type": 1,
            "header-block-2-sidebar": 1,
            "header-menu": 1,
            "header-mobile-menu": 1,
            "sticky-desktop": 1,
            "sticky-tablet": 1,
            "sticky-mobile": 1,
            "offcanvas-sidebar": 1,
            "offcanvas-togglevisibility": 1,
            "offcanvas-animation": 1,
            "dropdown-animation-effect": 1,
            "topsidebar-columns": 1,
            "miscellaneous-background-setting": 1,
            "footer-columns": 1,
            "topsidebar-column-1-sidebar": 1,
            "topsidebar-column-2-sidebar": 1,
            "topsidebar-column-3-sidebar": 1,
            "topsidebar-column-4-sidebar": 1,
            "topsidebar-column-5-sidebar": 1,
            "footer-column-1-sidebar": 1,
            "footer-column-2-sidebar": 1,
            "footer-column-3-sidebar": 1,
            "footer-column-4-sidebar": 1,
            "footer-column-5-sidebar": 1
        },
        "image_select": {
            "header-mode": 1,
            "header-horizontal-menu-mode": 1,
            "header-stacked-menu-mode": 1,
            "header-sidebar-menu-mode": 1,
            "sticky-menu-mode": 1
        },
        "textarea": {
            "header-block-1-custom": 1,
            "header-block-2-custom": 1,
            "miscellaneous-content": 1,
            "customcss-files": 1,
            "customjs-files": 1
        },
        "spinner": {"header-menu-level": 1, "header-mobile-menu-level": 1},
        "section": {
            "section-logo": 1,
            "section-sticky-header": 1,
            "section-offcanvas-menu": 1,
            "section-dropdown-animation": 1,
            "section-end": 1
        },
        "media": {
            "default-logo": 1,
            "mobile-logo": 1,
            "sidebar-logo": 1,
            "sticky-logo": 1,
            "miscellaneous-logo": 1,
            "404-background-video": 1,
            "favicon": 1
        },
        "tz_column": {
            "topsidebar-column-1": 1,
            "topsidebar-column-2": 1,
            "topsidebar-column-3": 1,
            "topsidebar-column-4": 1,
            "topsidebar-column-5": 1,
            "footer-column-1": 1,
            "footer-column-2": 1,
            "footer-column-3": 1,
            "footer-column-4": 1,
            "footer-column-5": 1
        },
        "typography": {
            "typography-body-option": 1,
            "typography-menu-option": 1,
            "typography-submenu-option": 1,
            "typography-h1-option": 1,
            "typography-h2-option": 1,
            "typography-h3-option": 1,
            "typography-h4-option": 1,
            "typography-h5-option": 1,
            "typography-h6-option": 1,
            "typography-top-bar-option": 1,
            "typography-footer-option": 1
        },
        "ace_editor": {
            "404-content": 1,
            "trackingcode-editor": 1,
            "beforehead-editor": 1,
            "beforebody-editor": 1,
            "customcss-editor": 1,
            "customjs": 1
        },
        "tz_layout": {"layout": 1},
        "options_object": {"redux_options_object": 1},
        "import_export": {"redux_import_export": 1}
    },
    "googlefonts": {
        "text": "Google Webfonts",
        "children": [{"id": "ABeeZee", "text": "ABeeZee", "data-google": "true"}, {
            "id": "Abel",
            "text": "Abel",
            "data-google": "true"
        }, {"id": "Abhaya Libre", "text": "Abhaya Libre", "data-google": "true"}, {
            "id": "Abril Fatface",
            "text": "Abril Fatface",
            "data-google": "true"
        }, {"id": "Aclonica", "text": "Aclonica", "data-google": "true"}, {
            "id": "Acme",
            "text": "Acme",
            "data-google": "true"
        }, {"id": "Actor", "text": "Actor", "data-google": "true"}, {
            "id": "Adamina",
            "text": "Adamina",
            "data-google": "true"
        }, {"id": "Advent Pro", "text": "Advent Pro", "data-google": "true"}, {
            "id": "Aguafina Script",
            "text": "Aguafina Script",
            "data-google": "true"
        }, {"id": "Akronim", "text": "Akronim", "data-google": "true"}, {
            "id": "Aladin",
            "text": "Aladin",
            "data-google": "true"
        }, {"id": "Aldrich", "text": "Aldrich", "data-google": "true"}, {
            "id": "Alef",
            "text": "Alef",
            "data-google": "true"
        }, {"id": "Alegreya", "text": "Alegreya", "data-google": "true"}, {
            "id": "Alegreya SC",
            "text": "Alegreya SC",
            "data-google": "true"
        }, {"id": "Alegreya Sans", "text": "Alegreya Sans", "data-google": "true"}, {
            "id": "Alegreya Sans SC",
            "text": "Alegreya Sans SC",
            "data-google": "true"
        }, {"id": "Alex Brush", "text": "Alex Brush", "data-google": "true"}, {
            "id": "Alfa Slab One",
            "text": "Alfa Slab One",
            "data-google": "true"
        }, {"id": "Alice", "text": "Alice", "data-google": "true"}, {
            "id": "Alike",
            "text": "Alike",
            "data-google": "true"
        }, {"id": "Alike Angular", "text": "Alike Angular", "data-google": "true"}, {
            "id": "Allan",
            "text": "Allan",
            "data-google": "true"
        }, {"id": "Allerta", "text": "Allerta", "data-google": "true"}, {
            "id": "Allerta Stencil",
            "text": "Allerta Stencil",
            "data-google": "true"
        }, {"id": "Allura", "text": "Allura", "data-google": "true"}, {
            "id": "Almendra",
            "text": "Almendra",
            "data-google": "true"
        }, {"id": "Almendra Display", "text": "Almendra Display", "data-google": "true"}, {
            "id": "Almendra SC",
            "text": "Almendra SC",
            "data-google": "true"
        }, {"id": "Amarante", "text": "Amarante", "data-google": "true"}, {
            "id": "Amaranth",
            "text": "Amaranth",
            "data-google": "true"
        }, {"id": "Amatic SC", "text": "Amatic SC", "data-google": "true"}, {
            "id": "Amethysta",
            "text": "Amethysta",
            "data-google": "true"
        }, {"id": "Amiko", "text": "Amiko", "data-google": "true"}, {
            "id": "Amiri",
            "text": "Amiri",
            "data-google": "true"
        }, {"id": "Amita", "text": "Amita", "data-google": "true"}, {
            "id": "Anaheim",
            "text": "Anaheim",
            "data-google": "true"
        }, {"id": "Andada", "text": "Andada", "data-google": "true"}, {
            "id": "Andika",
            "text": "Andika",
            "data-google": "true"
        }, {"id": "Angkor", "text": "Angkor", "data-google": "true"}, {
            "id": "Annie Use Your Telescope",
            "text": "Annie Use Your Telescope",
            "data-google": "true"
        }, {"id": "Anonymous Pro", "text": "Anonymous Pro", "data-google": "true"}, {
            "id": "Antic",
            "text": "Antic",
            "data-google": "true"
        }, {"id": "Antic Didone", "text": "Antic Didone", "data-google": "true"}, {
            "id": "Antic Slab",
            "text": "Antic Slab",
            "data-google": "true"
        }, {"id": "Anton", "text": "Anton", "data-google": "true"}, {
            "id": "Arapey",
            "text": "Arapey",
            "data-google": "true"
        }, {"id": "Arbutus", "text": "Arbutus", "data-google": "true"}, {
            "id": "Arbutus Slab",
            "text": "Arbutus Slab",
            "data-google": "true"
        }, {"id": "Architects Daughter", "text": "Architects Daughter", "data-google": "true"}, {
            "id": "Archivo",
            "text": "Archivo",
            "data-google": "true"
        }, {"id": "Archivo Black", "text": "Archivo Black", "data-google": "true"}, {
            "id": "Archivo Narrow",
            "text": "Archivo Narrow",
            "data-google": "true"
        }, {"id": "Aref Ruqaa", "text": "Aref Ruqaa", "data-google": "true"}, {
            "id": "Arima Madurai",
            "text": "Arima Madurai",
            "data-google": "true"
        }, {"id": "Arimo", "text": "Arimo", "data-google": "true"}, {
            "id": "Arizonia",
            "text": "Arizonia",
            "data-google": "true"
        }, {"id": "Armata", "text": "Armata", "data-google": "true"}, {
            "id": "Arsenal",
            "text": "Arsenal",
            "data-google": "true"
        }, {"id": "Artifika", "text": "Artifika", "data-google": "true"}, {
            "id": "Arvo",
            "text": "Arvo",
            "data-google": "true"
        }, {"id": "Arya", "text": "Arya", "data-google": "true"}, {
            "id": "Asap",
            "text": "Asap",
            "data-google": "true"
        }, {"id": "Asap Condensed", "text": "Asap Condensed", "data-google": "true"}, {
            "id": "Asar",
            "text": "Asar",
            "data-google": "true"
        }, {"id": "Asset", "text": "Asset", "data-google": "true"}, {
            "id": "Assistant",
            "text": "Assistant",
            "data-google": "true"
        }, {"id": "Astloch", "text": "Astloch", "data-google": "true"}, {
            "id": "Asul",
            "text": "Asul",
            "data-google": "true"
        }, {"id": "Athiti", "text": "Athiti", "data-google": "true"}, {
            "id": "Atma",
            "text": "Atma",
            "data-google": "true"
        }, {"id": "Atomic Age", "text": "Atomic Age", "data-google": "true"}, {
            "id": "Aubrey",
            "text": "Aubrey",
            "data-google": "true"
        }, {"id": "Audiowide", "text": "Audiowide", "data-google": "true"}, {
            "id": "Autour One",
            "text": "Autour One",
            "data-google": "true"
        }, {"id": "Average", "text": "Average", "data-google": "true"}, {
            "id": "Average Sans",
            "text": "Average Sans",
            "data-google": "true"
        }, {"id": "Averia Gruesa Libre", "text": "Averia Gruesa Libre", "data-google": "true"}, {
            "id": "Averia Libre",
            "text": "Averia Libre",
            "data-google": "true"
        }, {"id": "Averia Sans Libre", "text": "Averia Sans Libre", "data-google": "true"}, {
            "id": "Averia Serif Libre",
            "text": "Averia Serif Libre",
            "data-google": "true"
        }, {"id": "Bad Script", "text": "Bad Script", "data-google": "true"}, {
            "id": "Bahiana",
            "text": "Bahiana",
            "data-google": "true"
        }, {"id": "Baloo", "text": "Baloo", "data-google": "true"}, {
            "id": "Baloo Bhai",
            "text": "Baloo Bhai",
            "data-google": "true"
        }, {"id": "Baloo Bhaijaan", "text": "Baloo Bhaijaan", "data-google": "true"}, {
            "id": "Baloo Bhaina",
            "text": "Baloo Bhaina",
            "data-google": "true"
        }, {"id": "Baloo Chettan", "text": "Baloo Chettan", "data-google": "true"}, {
            "id": "Baloo Da",
            "text": "Baloo Da",
            "data-google": "true"
        }, {"id": "Baloo Paaji", "text": "Baloo Paaji", "data-google": "true"}, {
            "id": "Baloo Tamma",
            "text": "Baloo Tamma",
            "data-google": "true"
        }, {"id": "Baloo Tammudu", "text": "Baloo Tammudu", "data-google": "true"}, {
            "id": "Baloo Thambi",
            "text": "Baloo Thambi",
            "data-google": "true"
        }, {"id": "Balthazar", "text": "Balthazar", "data-google": "true"}, {
            "id": "Bangers",
            "text": "Bangers",
            "data-google": "true"
        }, {"id": "Barlow", "text": "Barlow", "data-google": "true"}, {
            "id": "Barlow Condensed",
            "text": "Barlow Condensed",
            "data-google": "true"
        }, {"id": "Barlow Semi Condensed", "text": "Barlow Semi Condensed", "data-google": "true"}, {
            "id": "Barrio",
            "text": "Barrio",
            "data-google": "true"
        }, {"id": "Basic", "text": "Basic", "data-google": "true"}, {
            "id": "Battambang",
            "text": "Battambang",
            "data-google": "true"
        }, {"id": "Baumans", "text": "Baumans", "data-google": "true"}, {
            "id": "Bayon",
            "text": "Bayon",
            "data-google": "true"
        }, {"id": "Belgrano", "text": "Belgrano", "data-google": "true"}, {
            "id": "Bellefair",
            "text": "Bellefair",
            "data-google": "true"
        }, {"id": "Belleza", "text": "Belleza", "data-google": "true"}, {
            "id": "BenchNine",
            "text": "BenchNine",
            "data-google": "true"
        }, {"id": "Bentham", "text": "Bentham", "data-google": "true"}, {
            "id": "Berkshire Swash",
            "text": "Berkshire Swash",
            "data-google": "true"
        }, {"id": "Bevan", "text": "Bevan", "data-google": "true"}, {
            "id": "Bigelow Rules",
            "text": "Bigelow Rules",
            "data-google": "true"
        }, {"id": "Bigshot One", "text": "Bigshot One", "data-google": "true"}, {
            "id": "Bilbo",
            "text": "Bilbo",
            "data-google": "true"
        }, {"id": "Bilbo Swash Caps", "text": "Bilbo Swash Caps", "data-google": "true"}, {
            "id": "BioRhyme",
            "text": "BioRhyme",
            "data-google": "true"
        }, {"id": "BioRhyme Expanded", "text": "BioRhyme Expanded", "data-google": "true"}, {
            "id": "Biryani",
            "text": "Biryani",
            "data-google": "true"
        }, {"id": "Bitter", "text": "Bitter", "data-google": "true"}, {
            "id": "Black And White Picture",
            "text": "Black And White Picture",
            "data-google": "true"
        }, {"id": "Black Han Sans", "text": "Black Han Sans", "data-google": "true"}, {
            "id": "Black Ops One",
            "text": "Black Ops One",
            "data-google": "true"
        }, {"id": "Bokor", "text": "Bokor", "data-google": "true"}, {
            "id": "Bonbon",
            "text": "Bonbon",
            "data-google": "true"
        }, {"id": "Boogaloo", "text": "Boogaloo", "data-google": "true"}, {
            "id": "Bowlby One",
            "text": "Bowlby One",
            "data-google": "true"
        }, {"id": "Bowlby One SC", "text": "Bowlby One SC", "data-google": "true"}, {
            "id": "Brawler",
            "text": "Brawler",
            "data-google": "true"
        }, {"id": "Bree Serif", "text": "Bree Serif", "data-google": "true"}, {
            "id": "Bubblegum Sans",
            "text": "Bubblegum Sans",
            "data-google": "true"
        }, {"id": "Bubbler One", "text": "Bubbler One", "data-google": "true"}, {
            "id": "Buda",
            "text": "Buda",
            "data-google": "true"
        }, {"id": "Buenard", "text": "Buenard", "data-google": "true"}, {
            "id": "Bungee",
            "text": "Bungee",
            "data-google": "true"
        }, {"id": "Bungee Hairline", "text": "Bungee Hairline", "data-google": "true"}, {
            "id": "Bungee Inline",
            "text": "Bungee Inline",
            "data-google": "true"
        }, {"id": "Bungee Outline", "text": "Bungee Outline", "data-google": "true"}, {
            "id": "Bungee Shade",
            "text": "Bungee Shade",
            "data-google": "true"
        }, {"id": "Butcherman", "text": "Butcherman", "data-google": "true"}, {
            "id": "Butterfly Kids",
            "text": "Butterfly Kids",
            "data-google": "true"
        }, {"id": "Cabin", "text": "Cabin", "data-google": "true"}, {
            "id": "Cabin Condensed",
            "text": "Cabin Condensed",
            "data-google": "true"
        }, {"id": "Cabin Sketch", "text": "Cabin Sketch", "data-google": "true"}, {
            "id": "Caesar Dressing",
            "text": "Caesar Dressing",
            "data-google": "true"
        }, {"id": "Cagliostro", "text": "Cagliostro", "data-google": "true"}, {
            "id": "Cairo",
            "text": "Cairo",
            "data-google": "true"
        }, {"id": "Calligraffitti", "text": "Calligraffitti", "data-google": "true"}, {
            "id": "Cambay",
            "text": "Cambay",
            "data-google": "true"
        }, {"id": "Cambo", "text": "Cambo", "data-google": "true"}, {
            "id": "Candal",
            "text": "Candal",
            "data-google": "true"
        }, {"id": "Cantarell", "text": "Cantarell", "data-google": "true"}, {
            "id": "Cantata One",
            "text": "Cantata One",
            "data-google": "true"
        }, {"id": "Cantora One", "text": "Cantora One", "data-google": "true"}, {
            "id": "Capriola",
            "text": "Capriola",
            "data-google": "true"
        }, {"id": "Cardo", "text": "Cardo", "data-google": "true"}, {
            "id": "Carme",
            "text": "Carme",
            "data-google": "true"
        }, {"id": "Carrois Gothic", "text": "Carrois Gothic", "data-google": "true"}, {
            "id": "Carrois Gothic SC",
            "text": "Carrois Gothic SC",
            "data-google": "true"
        }, {"id": "Carter One", "text": "Carter One", "data-google": "true"}, {
            "id": "Catamaran",
            "text": "Catamaran",
            "data-google": "true"
        }, {"id": "Caudex", "text": "Caudex", "data-google": "true"}, {
            "id": "Caveat",
            "text": "Caveat",
            "data-google": "true"
        }, {"id": "Caveat Brush", "text": "Caveat Brush", "data-google": "true"}, {
            "id": "Cedarville Cursive",
            "text": "Cedarville Cursive",
            "data-google": "true"
        }, {"id": "Ceviche One", "text": "Ceviche One", "data-google": "true"}, {
            "id": "Changa",
            "text": "Changa",
            "data-google": "true"
        }, {"id": "Changa One", "text": "Changa One", "data-google": "true"}, {
            "id": "Chango",
            "text": "Chango",
            "data-google": "true"
        }, {"id": "Chathura", "text": "Chathura", "data-google": "true"}, {
            "id": "Chau Philomene One",
            "text": "Chau Philomene One",
            "data-google": "true"
        }, {"id": "Chela One", "text": "Chela One", "data-google": "true"}, {
            "id": "Chelsea Market",
            "text": "Chelsea Market",
            "data-google": "true"
        }, {"id": "Chenla", "text": "Chenla", "data-google": "true"}, {
            "id": "Cherry Cream Soda",
            "text": "Cherry Cream Soda",
            "data-google": "true"
        }, {"id": "Cherry Swash", "text": "Cherry Swash", "data-google": "true"}, {
            "id": "Chewy",
            "text": "Chewy",
            "data-google": "true"
        }, {"id": "Chicle", "text": "Chicle", "data-google": "true"}, {
            "id": "Chivo",
            "text": "Chivo",
            "data-google": "true"
        }, {"id": "Chonburi", "text": "Chonburi", "data-google": "true"}, {
            "id": "Cinzel",
            "text": "Cinzel",
            "data-google": "true"
        }, {"id": "Cinzel Decorative", "text": "Cinzel Decorative", "data-google": "true"}, {
            "id": "Clicker Script",
            "text": "Clicker Script",
            "data-google": "true"
        }, {"id": "Coda", "text": "Coda", "data-google": "true"}, {
            "id": "Coda Caption",
            "text": "Coda Caption",
            "data-google": "true"
        }, {"id": "Codystar", "text": "Codystar", "data-google": "true"}, {
            "id": "Coiny",
            "text": "Coiny",
            "data-google": "true"
        }, {"id": "Combo", "text": "Combo", "data-google": "true"}, {
            "id": "Comfortaa",
            "text": "Comfortaa",
            "data-google": "true"
        }, {"id": "Coming Soon", "text": "Coming Soon", "data-google": "true"}, {
            "id": "Concert One",
            "text": "Concert One",
            "data-google": "true"
        }, {"id": "Condiment", "text": "Condiment", "data-google": "true"}, {
            "id": "Content",
            "text": "Content",
            "data-google": "true"
        }, {"id": "Contrail One", "text": "Contrail One", "data-google": "true"}, {
            "id": "Convergence",
            "text": "Convergence",
            "data-google": "true"
        }, {"id": "Cookie", "text": "Cookie", "data-google": "true"}, {
            "id": "Copse",
            "text": "Copse",
            "data-google": "true"
        }, {"id": "Corben", "text": "Corben", "data-google": "true"}, {
            "id": "Cormorant",
            "text": "Cormorant",
            "data-google": "true"
        }, {"id": "Cormorant Garamond", "text": "Cormorant Garamond", "data-google": "true"}, {
            "id": "Cormorant Infant",
            "text": "Cormorant Infant",
            "data-google": "true"
        }, {"id": "Cormorant SC", "text": "Cormorant SC", "data-google": "true"}, {
            "id": "Cormorant Unicase",
            "text": "Cormorant Unicase",
            "data-google": "true"
        }, {"id": "Cormorant Upright", "text": "Cormorant Upright", "data-google": "true"}, {
            "id": "Courgette",
            "text": "Courgette",
            "data-google": "true"
        }, {"id": "Cousine", "text": "Cousine", "data-google": "true"}, {
            "id": "Coustard",
            "text": "Coustard",
            "data-google": "true"
        }, {
            "id": "Covered By Your Grace",
            "text": "Covered By Your Grace",
            "data-google": "true"
        }, {"id": "Crafty Girls", "text": "Crafty Girls", "data-google": "true"}, {
            "id": "Creepster",
            "text": "Creepster",
            "data-google": "true"
        }, {"id": "Crete Round", "text": "Crete Round", "data-google": "true"}, {
            "id": "Crimson Text",
            "text": "Crimson Text",
            "data-google": "true"
        }, {"id": "Croissant One", "text": "Croissant One", "data-google": "true"}, {
            "id": "Crushed",
            "text": "Crushed",
            "data-google": "true"
        }, {"id": "Cuprum", "text": "Cuprum", "data-google": "true"}, {
            "id": "Cute Font",
            "text": "Cute Font",
            "data-google": "true"
        }, {"id": "Cutive", "text": "Cutive", "data-google": "true"}, {
            "id": "Cutive Mono",
            "text": "Cutive Mono",
            "data-google": "true"
        }, {"id": "Damion", "text": "Damion", "data-google": "true"}, {
            "id": "Dancing Script",
            "text": "Dancing Script",
            "data-google": "true"
        }, {"id": "Dangrek", "text": "Dangrek", "data-google": "true"}, {
            "id": "David Libre",
            "text": "David Libre",
            "data-google": "true"
        }, {"id": "Dawning of a New Day", "text": "Dawning of a New Day", "data-google": "true"}, {
            "id": "Days One",
            "text": "Days One",
            "data-google": "true"
        }, {"id": "Dekko", "text": "Dekko", "data-google": "true"}, {
            "id": "Delius",
            "text": "Delius",
            "data-google": "true"
        }, {"id": "Delius Swash Caps", "text": "Delius Swash Caps", "data-google": "true"}, {
            "id": "Delius Unicase",
            "text": "Delius Unicase",
            "data-google": "true"
        }, {"id": "Della Respira", "text": "Della Respira", "data-google": "true"}, {
            "id": "Denk One",
            "text": "Denk One",
            "data-google": "true"
        }, {"id": "Devonshire", "text": "Devonshire", "data-google": "true"}, {
            "id": "Dhurjati",
            "text": "Dhurjati",
            "data-google": "true"
        }, {"id": "Didact Gothic", "text": "Didact Gothic", "data-google": "true"}, {
            "id": "Diplomata",
            "text": "Diplomata",
            "data-google": "true"
        }, {"id": "Diplomata SC", "text": "Diplomata SC", "data-google": "true"}, {
            "id": "Do Hyeon",
            "text": "Do Hyeon",
            "data-google": "true"
        }, {"id": "Dokdo", "text": "Dokdo", "data-google": "true"}, {
            "id": "Domine",
            "text": "Domine",
            "data-google": "true"
        }, {"id": "Donegal One", "text": "Donegal One", "data-google": "true"}, {
            "id": "Doppio One",
            "text": "Doppio One",
            "data-google": "true"
        }, {"id": "Dorsa", "text": "Dorsa", "data-google": "true"}, {
            "id": "Dosis",
            "text": "Dosis",
            "data-google": "true"
        }, {"id": "Dr Sugiyama", "text": "Dr Sugiyama", "data-google": "true"}, {
            "id": "Duru Sans",
            "text": "Duru Sans",
            "data-google": "true"
        }, {"id": "Dynalight", "text": "Dynalight", "data-google": "true"}, {
            "id": "EB Garamond",
            "text": "EB Garamond",
            "data-google": "true"
        }, {"id": "Eagle Lake", "text": "Eagle Lake", "data-google": "true"}, {
            "id": "East Sea Dokdo",
            "text": "East Sea Dokdo",
            "data-google": "true"
        }, {"id": "Eater", "text": "Eater", "data-google": "true"}, {
            "id": "Economica",
            "text": "Economica",
            "data-google": "true"
        }, {"id": "Eczar", "text": "Eczar", "data-google": "true"}, {
            "id": "El Messiri",
            "text": "El Messiri",
            "data-google": "true"
        }, {"id": "Electrolize", "text": "Electrolize", "data-google": "true"}, {
            "id": "Elsie",
            "text": "Elsie",
            "data-google": "true"
        }, {"id": "Elsie Swash Caps", "text": "Elsie Swash Caps", "data-google": "true"}, {
            "id": "Emblema One",
            "text": "Emblema One",
            "data-google": "true"
        }, {"id": "Emilys Candy", "text": "Emilys Candy", "data-google": "true"}, {
            "id": "Encode Sans",
            "text": "Encode Sans",
            "data-google": "true"
        }, {
            "id": "Encode Sans Condensed",
            "text": "Encode Sans Condensed",
            "data-google": "true"
        }, {
            "id": "Encode Sans Expanded",
            "text": "Encode Sans Expanded",
            "data-google": "true"
        }, {
            "id": "Encode Sans Semi Condensed",
            "text": "Encode Sans Semi Condensed",
            "data-google": "true"
        }, {
            "id": "Encode Sans Semi Expanded",
            "text": "Encode Sans Semi Expanded",
            "data-google": "true"
        }, {"id": "Engagement", "text": "Engagement", "data-google": "true"}, {
            "id": "Englebert",
            "text": "Englebert",
            "data-google": "true"
        }, {"id": "Enriqueta", "text": "Enriqueta", "data-google": "true"}, {
            "id": "Erica One",
            "text": "Erica One",
            "data-google": "true"
        }, {"id": "Esteban", "text": "Esteban", "data-google": "true"}, {
            "id": "Euphoria Script",
            "text": "Euphoria Script",
            "data-google": "true"
        }, {"id": "Ewert", "text": "Ewert", "data-google": "true"}, {
            "id": "Exo",
            "text": "Exo",
            "data-google": "true"
        }, {"id": "Exo 2", "text": "Exo 2", "data-google": "true"}, {
            "id": "Expletus Sans",
            "text": "Expletus Sans",
            "data-google": "true"
        }, {"id": "Fanwood Text", "text": "Fanwood Text", "data-google": "true"}, {
            "id": "Farsan",
            "text": "Farsan",
            "data-google": "true"
        }, {"id": "Fascinate", "text": "Fascinate", "data-google": "true"}, {
            "id": "Fascinate Inline",
            "text": "Fascinate Inline",
            "data-google": "true"
        }, {"id": "Faster One", "text": "Faster One", "data-google": "true"}, {
            "id": "Fasthand",
            "text": "Fasthand",
            "data-google": "true"
        }, {"id": "Fauna One", "text": "Fauna One", "data-google": "true"}, {
            "id": "Faustina",
            "text": "Faustina",
            "data-google": "true"
        }, {"id": "Federant", "text": "Federant", "data-google": "true"}, {
            "id": "Federo",
            "text": "Federo",
            "data-google": "true"
        }, {"id": "Felipa", "text": "Felipa", "data-google": "true"}, {
            "id": "Fenix",
            "text": "Fenix",
            "data-google": "true"
        }, {"id": "Finger Paint", "text": "Finger Paint", "data-google": "true"}, {
            "id": "Fira Mono",
            "text": "Fira Mono",
            "data-google": "true"
        }, {"id": "Fira Sans", "text": "Fira Sans", "data-google": "true"}, {
            "id": "Fira Sans Condensed",
            "text": "Fira Sans Condensed",
            "data-google": "true"
        }, {
            "id": "Fira Sans Extra Condensed",
            "text": "Fira Sans Extra Condensed",
            "data-google": "true"
        }, {"id": "Fjalla One", "text": "Fjalla One", "data-google": "true"}, {
            "id": "Fjord One",
            "text": "Fjord One",
            "data-google": "true"
        }, {"id": "Flamenco", "text": "Flamenco", "data-google": "true"}, {
            "id": "Flavors",
            "text": "Flavors",
            "data-google": "true"
        }, {"id": "Fondamento", "text": "Fondamento", "data-google": "true"}, {
            "id": "Fontdiner Swanky",
            "text": "Fontdiner Swanky",
            "data-google": "true"
        }, {"id": "Forum", "text": "Forum", "data-google": "true"}, {
            "id": "Francois One",
            "text": "Francois One",
            "data-google": "true"
        }, {"id": "Frank Ruhl Libre", "text": "Frank Ruhl Libre", "data-google": "true"}, {
            "id": "Freckle Face",
            "text": "Freckle Face",
            "data-google": "true"
        }, {"id": "Fredericka the Great", "text": "Fredericka the Great", "data-google": "true"}, {
            "id": "Fredoka One",
            "text": "Fredoka One",
            "data-google": "true"
        }, {"id": "Freehand", "text": "Freehand", "data-google": "true"}, {
            "id": "Fresca",
            "text": "Fresca",
            "data-google": "true"
        }, {"id": "Frijole", "text": "Frijole", "data-google": "true"}, {
            "id": "Fruktur",
            "text": "Fruktur",
            "data-google": "true"
        }, {"id": "Fugaz One", "text": "Fugaz One", "data-google": "true"}, {
            "id": "GFS Didot",
            "text": "GFS Didot",
            "data-google": "true"
        }, {"id": "GFS Neohellenic", "text": "GFS Neohellenic", "data-google": "true"}, {
            "id": "Gabriela",
            "text": "Gabriela",
            "data-google": "true"
        }, {"id": "Gaegu", "text": "Gaegu", "data-google": "true"}, {
            "id": "Gafata",
            "text": "Gafata",
            "data-google": "true"
        }, {"id": "Galada", "text": "Galada", "data-google": "true"}, {
            "id": "Galdeano",
            "text": "Galdeano",
            "data-google": "true"
        }, {"id": "Galindo", "text": "Galindo", "data-google": "true"}, {
            "id": "Gamja Flower",
            "text": "Gamja Flower",
            "data-google": "true"
        }, {"id": "Gentium Basic", "text": "Gentium Basic", "data-google": "true"}, {
            "id": "Gentium Book Basic",
            "text": "Gentium Book Basic",
            "data-google": "true"
        }, {"id": "Geo", "text": "Geo", "data-google": "true"}, {
            "id": "Geostar",
            "text": "Geostar",
            "data-google": "true"
        }, {"id": "Geostar Fill", "text": "Geostar Fill", "data-google": "true"}, {
            "id": "Germania One",
            "text": "Germania One",
            "data-google": "true"
        }, {"id": "Gidugu", "text": "Gidugu", "data-google": "true"}, {
            "id": "Gilda Display",
            "text": "Gilda Display",
            "data-google": "true"
        }, {"id": "Give You Glory", "text": "Give You Glory", "data-google": "true"}, {
            "id": "Glass Antiqua",
            "text": "Glass Antiqua",
            "data-google": "true"
        }, {"id": "Glegoo", "text": "Glegoo", "data-google": "true"}, {
            "id": "Gloria Hallelujah",
            "text": "Gloria Hallelujah",
            "data-google": "true"
        }, {"id": "Goblin One", "text": "Goblin One", "data-google": "true"}, {
            "id": "Gochi Hand",
            "text": "Gochi Hand",
            "data-google": "true"
        }, {"id": "Gorditas", "text": "Gorditas", "data-google": "true"}, {
            "id": "Gothic A1",
            "text": "Gothic A1",
            "data-google": "true"
        }, {"id": "Goudy Bookletter 1911", "text": "Goudy Bookletter 1911", "data-google": "true"}, {
            "id": "Graduate",
            "text": "Graduate",
            "data-google": "true"
        }, {"id": "Grand Hotel", "text": "Grand Hotel", "data-google": "true"}, {
            "id": "Gravitas One",
            "text": "Gravitas One",
            "data-google": "true"
        }, {"id": "Great Vibes", "text": "Great Vibes", "data-google": "true"}, {
            "id": "Griffy",
            "text": "Griffy",
            "data-google": "true"
        }, {"id": "Gruppo", "text": "Gruppo", "data-google": "true"}, {
            "id": "Gudea",
            "text": "Gudea",
            "data-google": "true"
        }, {"id": "Gugi", "text": "Gugi", "data-google": "true"}, {
            "id": "Gurajada",
            "text": "Gurajada",
            "data-google": "true"
        }, {"id": "Habibi", "text": "Habibi", "data-google": "true"}, {
            "id": "Halant",
            "text": "Halant",
            "data-google": "true"
        }, {"id": "Hammersmith One", "text": "Hammersmith One", "data-google": "true"}, {
            "id": "Hanalei",
            "text": "Hanalei",
            "data-google": "true"
        }, {"id": "Hanalei Fill", "text": "Hanalei Fill", "data-google": "true"}, {
            "id": "Handlee",
            "text": "Handlee",
            "data-google": "true"
        }, {"id": "Hanuman", "text": "Hanuman", "data-google": "true"}, {
            "id": "Happy Monkey",
            "text": "Happy Monkey",
            "data-google": "true"
        }, {"id": "Harmattan", "text": "Harmattan", "data-google": "true"}, {
            "id": "Headland One",
            "text": "Headland One",
            "data-google": "true"
        }, {"id": "Heebo", "text": "Heebo", "data-google": "true"}, {
            "id": "Henny Penny",
            "text": "Henny Penny",
            "data-google": "true"
        }, {"id": "Herr Von Muellerhoff", "text": "Herr Von Muellerhoff", "data-google": "true"}, {
            "id": "Hi Melody",
            "text": "Hi Melody",
            "data-google": "true"
        }, {"id": "Hind", "text": "Hind", "data-google": "true"}, {
            "id": "Hind Guntur",
            "text": "Hind Guntur",
            "data-google": "true"
        }, {"id": "Hind Madurai", "text": "Hind Madurai", "data-google": "true"}, {
            "id": "Hind Siliguri",
            "text": "Hind Siliguri",
            "data-google": "true"
        }, {"id": "Hind Vadodara", "text": "Hind Vadodara", "data-google": "true"}, {
            "id": "Holtwood One SC",
            "text": "Holtwood One SC",
            "data-google": "true"
        }, {"id": "Homemade Apple", "text": "Homemade Apple", "data-google": "true"}, {
            "id": "Homenaje",
            "text": "Homenaje",
            "data-google": "true"
        }, {"id": "IBM Plex Mono", "text": "IBM Plex Mono", "data-google": "true"}, {
            "id": "IBM Plex Sans",
            "text": "IBM Plex Sans",
            "data-google": "true"
        }, {
            "id": "IBM Plex Sans Condensed",
            "text": "IBM Plex Sans Condensed",
            "data-google": "true"
        }, {"id": "IBM Plex Serif", "text": "IBM Plex Serif", "data-google": "true"}, {
            "id": "IM Fell DW Pica",
            "text": "IM Fell DW Pica",
            "data-google": "true"
        }, {
            "id": "IM Fell DW Pica SC",
            "text": "IM Fell DW Pica SC",
            "data-google": "true"
        }, {
            "id": "IM Fell Double Pica",
            "text": "IM Fell Double Pica",
            "data-google": "true"
        }, {
            "id": "IM Fell Double Pica SC",
            "text": "IM Fell Double Pica SC",
            "data-google": "true"
        }, {"id": "IM Fell English", "text": "IM Fell English", "data-google": "true"}, {
            "id": "IM Fell English SC",
            "text": "IM Fell English SC",
            "data-google": "true"
        }, {
            "id": "IM Fell French Canon",
            "text": "IM Fell French Canon",
            "data-google": "true"
        }, {
            "id": "IM Fell French Canon SC",
            "text": "IM Fell French Canon SC",
            "data-google": "true"
        }, {
            "id": "IM Fell Great Primer",
            "text": "IM Fell Great Primer",
            "data-google": "true"
        }, {
            "id": "IM Fell Great Primer SC",
            "text": "IM Fell Great Primer SC",
            "data-google": "true"
        }, {"id": "Iceberg", "text": "Iceberg", "data-google": "true"}, {
            "id": "Iceland",
            "text": "Iceland",
            "data-google": "true"
        }, {"id": "Imprima", "text": "Imprima", "data-google": "true"}, {
            "id": "Inconsolata",
            "text": "Inconsolata",
            "data-google": "true"
        }, {"id": "Inder", "text": "Inder", "data-google": "true"}, {
            "id": "Indie Flower",
            "text": "Indie Flower",
            "data-google": "true"
        }, {"id": "Inika", "text": "Inika", "data-google": "true"}, {
            "id": "Inknut Antiqua",
            "text": "Inknut Antiqua",
            "data-google": "true"
        }, {"id": "Irish Grover", "text": "Irish Grover", "data-google": "true"}, {
            "id": "Istok Web",
            "text": "Istok Web",
            "data-google": "true"
        }, {"id": "Italiana", "text": "Italiana", "data-google": "true"}, {
            "id": "Italianno",
            "text": "Italianno",
            "data-google": "true"
        }, {"id": "Itim", "text": "Itim", "data-google": "true"}, {
            "id": "Jacques Francois",
            "text": "Jacques Francois",
            "data-google": "true"
        }, {"id": "Jacques Francois Shadow", "text": "Jacques Francois Shadow", "data-google": "true"}, {
            "id": "Jaldi",
            "text": "Jaldi",
            "data-google": "true"
        }, {"id": "Jim Nightshade", "text": "Jim Nightshade", "data-google": "true"}, {
            "id": "Jockey One",
            "text": "Jockey One",
            "data-google": "true"
        }, {"id": "Jolly Lodger", "text": "Jolly Lodger", "data-google": "true"}, {
            "id": "Jomhuria",
            "text": "Jomhuria",
            "data-google": "true"
        }, {"id": "Josefin Sans", "text": "Josefin Sans", "data-google": "true"}, {
            "id": "Josefin Slab",
            "text": "Josefin Slab",
            "data-google": "true"
        }, {"id": "Joti One", "text": "Joti One", "data-google": "true"}, {
            "id": "Jua",
            "text": "Jua",
            "data-google": "true"
        }, {"id": "Judson", "text": "Judson", "data-google": "true"}, {
            "id": "Julee",
            "text": "Julee",
            "data-google": "true"
        }, {"id": "Julius Sans One", "text": "Julius Sans One", "data-google": "true"}, {
            "id": "Junge",
            "text": "Junge",
            "data-google": "true"
        }, {"id": "Jura", "text": "Jura", "data-google": "true"}, {
            "id": "Just Another Hand",
            "text": "Just Another Hand",
            "data-google": "true"
        }, {"id": "Just Me Again Down Here", "text": "Just Me Again Down Here", "data-google": "true"}, {
            "id": "Kadwa",
            "text": "Kadwa",
            "data-google": "true"
        }, {"id": "Kalam", "text": "Kalam", "data-google": "true"}, {
            "id": "Kameron",
            "text": "Kameron",
            "data-google": "true"
        }, {"id": "Kanit", "text": "Kanit", "data-google": "true"}, {
            "id": "Kantumruy",
            "text": "Kantumruy",
            "data-google": "true"
        }, {"id": "Karla", "text": "Karla", "data-google": "true"}, {
            "id": "Karma",
            "text": "Karma",
            "data-google": "true"
        }, {"id": "Katibeh", "text": "Katibeh", "data-google": "true"}, {
            "id": "Kaushan Script",
            "text": "Kaushan Script",
            "data-google": "true"
        }, {"id": "Kavivanar", "text": "Kavivanar", "data-google": "true"}, {
            "id": "Kavoon",
            "text": "Kavoon",
            "data-google": "true"
        }, {"id": "Kdam Thmor", "text": "Kdam Thmor", "data-google": "true"}, {
            "id": "Keania One",
            "text": "Keania One",
            "data-google": "true"
        }, {"id": "Kelly Slab", "text": "Kelly Slab", "data-google": "true"}, {
            "id": "Kenia",
            "text": "Kenia",
            "data-google": "true"
        }, {"id": "Khand", "text": "Khand", "data-google": "true"}, {
            "id": "Khmer",
            "text": "Khmer",
            "data-google": "true"
        }, {"id": "Khula", "text": "Khula", "data-google": "true"}, {
            "id": "Kirang Haerang",
            "text": "Kirang Haerang",
            "data-google": "true"
        }, {"id": "Kite One", "text": "Kite One", "data-google": "true"}, {
            "id": "Knewave",
            "text": "Knewave",
            "data-google": "true"
        }, {"id": "Kotta One", "text": "Kotta One", "data-google": "true"}, {
            "id": "Koulen",
            "text": "Koulen",
            "data-google": "true"
        }, {"id": "Kranky", "text": "Kranky", "data-google": "true"}, {
            "id": "Kreon",
            "text": "Kreon",
            "data-google": "true"
        }, {"id": "Kristi", "text": "Kristi", "data-google": "true"}, {
            "id": "Krona One",
            "text": "Krona One",
            "data-google": "true"
        }, {"id": "Kumar One", "text": "Kumar One", "data-google": "true"}, {
            "id": "Kumar One Outline",
            "text": "Kumar One Outline",
            "data-google": "true"
        }, {"id": "Kurale", "text": "Kurale", "data-google": "true"}, {
            "id": "La Belle Aurore",
            "text": "La Belle Aurore",
            "data-google": "true"
        }, {"id": "Laila", "text": "Laila", "data-google": "true"}, {
            "id": "Lakki Reddy",
            "text": "Lakki Reddy",
            "data-google": "true"
        }, {"id": "Lalezar", "text": "Lalezar", "data-google": "true"}, {
            "id": "Lancelot",
            "text": "Lancelot",
            "data-google": "true"
        }, {"id": "Lateef", "text": "Lateef", "data-google": "true"}, {
            "id": "Lato",
            "text": "Lato",
            "data-google": "true"
        }, {"id": "League Script", "text": "League Script", "data-google": "true"}, {
            "id": "Leckerli One",
            "text": "Leckerli One",
            "data-google": "true"
        }, {"id": "Ledger", "text": "Ledger", "data-google": "true"}, {
            "id": "Lekton",
            "text": "Lekton",
            "data-google": "true"
        }, {"id": "Lemon", "text": "Lemon", "data-google": "true"}, {
            "id": "Lemonada",
            "text": "Lemonada",
            "data-google": "true"
        }, {
            "id": "Libre Barcode 128",
            "text": "Libre Barcode 128",
            "data-google": "true"
        }, {
            "id": "Libre Barcode 128 Text",
            "text": "Libre Barcode 128 Text",
            "data-google": "true"
        }, {
            "id": "Libre Barcode 39",
            "text": "Libre Barcode 39",
            "data-google": "true"
        }, {
            "id": "Libre Barcode 39 Extended",
            "text": "Libre Barcode 39 Extended",
            "data-google": "true"
        }, {
            "id": "Libre Barcode 39 Extended Text",
            "text": "Libre Barcode 39 Extended Text",
            "data-google": "true"
        }, {
            "id": "Libre Barcode 39 Text",
            "text": "Libre Barcode 39 Text",
            "data-google": "true"
        }, {"id": "Libre Baskerville", "text": "Libre Baskerville", "data-google": "true"}, {
            "id": "Libre Franklin",
            "text": "Libre Franklin",
            "data-google": "true"
        }, {"id": "Life Savers", "text": "Life Savers", "data-google": "true"}, {
            "id": "Lilita One",
            "text": "Lilita One",
            "data-google": "true"
        }, {"id": "Lily Script One", "text": "Lily Script One", "data-google": "true"}, {
            "id": "Limelight",
            "text": "Limelight",
            "data-google": "true"
        }, {"id": "Linden Hill", "text": "Linden Hill", "data-google": "true"}, {
            "id": "Lobster",
            "text": "Lobster",
            "data-google": "true"
        }, {"id": "Lobster Two", "text": "Lobster Two", "data-google": "true"}, {
            "id": "Londrina Outline",
            "text": "Londrina Outline",
            "data-google": "true"
        }, {"id": "Londrina Shadow", "text": "Londrina Shadow", "data-google": "true"}, {
            "id": "Londrina Sketch",
            "text": "Londrina Sketch",
            "data-google": "true"
        }, {"id": "Londrina Solid", "text": "Londrina Solid", "data-google": "true"}, {
            "id": "Lora",
            "text": "Lora",
            "data-google": "true"
        }, {
            "id": "Love Ya Like A Sister",
            "text": "Love Ya Like A Sister",
            "data-google": "true"
        }, {"id": "Loved by the King", "text": "Loved by the King", "data-google": "true"}, {
            "id": "Lovers Quarrel",
            "text": "Lovers Quarrel",
            "data-google": "true"
        }, {"id": "Luckiest Guy", "text": "Luckiest Guy", "data-google": "true"}, {
            "id": "Lusitana",
            "text": "Lusitana",
            "data-google": "true"
        }, {"id": "Lustria", "text": "Lustria", "data-google": "true"}, {
            "id": "Macondo",
            "text": "Macondo",
            "data-google": "true"
        }, {"id": "Macondo Swash Caps", "text": "Macondo Swash Caps", "data-google": "true"}, {
            "id": "Mada",
            "text": "Mada",
            "data-google": "true"
        }, {"id": "Magra", "text": "Magra", "data-google": "true"}, {
            "id": "Maiden Orange",
            "text": "Maiden Orange",
            "data-google": "true"
        }, {"id": "Maitree", "text": "Maitree", "data-google": "true"}, {
            "id": "Mako",
            "text": "Mako",
            "data-google": "true"
        }, {"id": "Mallanna", "text": "Mallanna", "data-google": "true"}, {
            "id": "Mandali",
            "text": "Mandali",
            "data-google": "true"
        }, {"id": "Manuale", "text": "Manuale", "data-google": "true"}, {
            "id": "Marcellus",
            "text": "Marcellus",
            "data-google": "true"
        }, {"id": "Marcellus SC", "text": "Marcellus SC", "data-google": "true"}, {
            "id": "Marck Script",
            "text": "Marck Script",
            "data-google": "true"
        }, {"id": "Margarine", "text": "Margarine", "data-google": "true"}, {
            "id": "Markazi Text",
            "text": "Markazi Text",
            "data-google": "true"
        }, {"id": "Marko One", "text": "Marko One", "data-google": "true"}, {
            "id": "Marmelad",
            "text": "Marmelad",
            "data-google": "true"
        }, {"id": "Martel", "text": "Martel", "data-google": "true"}, {
            "id": "Martel Sans",
            "text": "Martel Sans",
            "data-google": "true"
        }, {"id": "Marvel", "text": "Marvel", "data-google": "true"}, {
            "id": "Mate",
            "text": "Mate",
            "data-google": "true"
        }, {"id": "Mate SC", "text": "Mate SC", "data-google": "true"}, {
            "id": "Maven Pro",
            "text": "Maven Pro",
            "data-google": "true"
        }, {"id": "McLaren", "text": "McLaren", "data-google": "true"}, {
            "id": "Meddon",
            "text": "Meddon",
            "data-google": "true"
        }, {"id": "MedievalSharp", "text": "MedievalSharp", "data-google": "true"}, {
            "id": "Medula One",
            "text": "Medula One",
            "data-google": "true"
        }, {"id": "Meera Inimai", "text": "Meera Inimai", "data-google": "true"}, {
            "id": "Megrim",
            "text": "Megrim",
            "data-google": "true"
        }, {"id": "Meie Script", "text": "Meie Script", "data-google": "true"}, {
            "id": "Merienda",
            "text": "Merienda",
            "data-google": "true"
        }, {"id": "Merienda One", "text": "Merienda One", "data-google": "true"}, {
            "id": "Merriweather",
            "text": "Merriweather",
            "data-google": "true"
        }, {"id": "Merriweather Sans", "text": "Merriweather Sans", "data-google": "true"}, {
            "id": "Metal",
            "text": "Metal",
            "data-google": "true"
        }, {"id": "Metal Mania", "text": "Metal Mania", "data-google": "true"}, {
            "id": "Metamorphous",
            "text": "Metamorphous",
            "data-google": "true"
        }, {"id": "Metrophobic", "text": "Metrophobic", "data-google": "true"}, {
            "id": "Michroma",
            "text": "Michroma",
            "data-google": "true"
        }, {"id": "Milonga", "text": "Milonga", "data-google": "true"}, {
            "id": "Miltonian",
            "text": "Miltonian",
            "data-google": "true"
        }, {"id": "Miltonian Tattoo", "text": "Miltonian Tattoo", "data-google": "true"}, {
            "id": "Mina",
            "text": "Mina",
            "data-google": "true"
        }, {"id": "Miniver", "text": "Miniver", "data-google": "true"}, {
            "id": "Miriam Libre",
            "text": "Miriam Libre",
            "data-google": "true"
        }, {"id": "Mirza", "text": "Mirza", "data-google": "true"}, {
            "id": "Miss Fajardose",
            "text": "Miss Fajardose",
            "data-google": "true"
        }, {"id": "Mitr", "text": "Mitr", "data-google": "true"}, {
            "id": "Modak",
            "text": "Modak",
            "data-google": "true"
        }, {"id": "Modern Antiqua", "text": "Modern Antiqua", "data-google": "true"}, {
            "id": "Mogra",
            "text": "Mogra",
            "data-google": "true"
        }, {"id": "Molengo", "text": "Molengo", "data-google": "true"}, {
            "id": "Molle",
            "text": "Molle",
            "data-google": "true"
        }, {"id": "Monda", "text": "Monda", "data-google": "true"}, {
            "id": "Monofett",
            "text": "Monofett",
            "data-google": "true"
        }, {"id": "Monoton", "text": "Monoton", "data-google": "true"}, {
            "id": "Monsieur La Doulaise",
            "text": "Monsieur La Doulaise",
            "data-google": "true"
        }, {"id": "Montaga", "text": "Montaga", "data-google": "true"}, {
            "id": "Montez",
            "text": "Montez",
            "data-google": "true"
        }, {"id": "Montserrat", "text": "Montserrat", "data-google": "true"}, {
            "id": "Montserrat Alternates",
            "text": "Montserrat Alternates",
            "data-google": "true"
        }, {"id": "Montserrat Subrayada", "text": "Montserrat Subrayada", "data-google": "true"}, {
            "id": "Moul",
            "text": "Moul",
            "data-google": "true"
        }, {"id": "Moulpali", "text": "Moulpali", "data-google": "true"}, {
            "id": "Mountains of Christmas",
            "text": "Mountains of Christmas",
            "data-google": "true"
        }, {"id": "Mouse Memoirs", "text": "Mouse Memoirs", "data-google": "true"}, {
            "id": "Mr Bedfort",
            "text": "Mr Bedfort",
            "data-google": "true"
        }, {"id": "Mr Dafoe", "text": "Mr Dafoe", "data-google": "true"}, {
            "id": "Mr De Haviland",
            "text": "Mr De Haviland",
            "data-google": "true"
        }, {"id": "Mrs Saint Delafield", "text": "Mrs Saint Delafield", "data-google": "true"}, {
            "id": "Mrs Sheppards",
            "text": "Mrs Sheppards",
            "data-google": "true"
        }, {"id": "Mukta", "text": "Mukta", "data-google": "true"}, {
            "id": "Mukta Mahee",
            "text": "Mukta Mahee",
            "data-google": "true"
        }, {"id": "Mukta Malar", "text": "Mukta Malar", "data-google": "true"}, {
            "id": "Mukta Vaani",
            "text": "Mukta Vaani",
            "data-google": "true"
        }, {"id": "Muli", "text": "Muli", "data-google": "true"}, {
            "id": "Mystery Quest",
            "text": "Mystery Quest",
            "data-google": "true"
        }, {"id": "NTR", "text": "NTR", "data-google": "true"}, {
            "id": "Nanum Brush Script",
            "text": "Nanum Brush Script",
            "data-google": "true"
        }, {"id": "Nanum Gothic", "text": "Nanum Gothic", "data-google": "true"}, {
            "id": "Nanum Gothic Coding",
            "text": "Nanum Gothic Coding",
            "data-google": "true"
        }, {"id": "Nanum Myeongjo", "text": "Nanum Myeongjo", "data-google": "true"}, {
            "id": "Nanum Pen Script",
            "text": "Nanum Pen Script",
            "data-google": "true"
        }, {"id": "Neucha", "text": "Neucha", "data-google": "true"}, {
            "id": "Neuton",
            "text": "Neuton",
            "data-google": "true"
        }, {"id": "New Rocker", "text": "New Rocker", "data-google": "true"}, {
            "id": "News Cycle",
            "text": "News Cycle",
            "data-google": "true"
        }, {"id": "Niconne", "text": "Niconne", "data-google": "true"}, {
            "id": "Nixie One",
            "text": "Nixie One",
            "data-google": "true"
        }, {"id": "Nobile", "text": "Nobile", "data-google": "true"}, {
            "id": "Nokora",
            "text": "Nokora",
            "data-google": "true"
        }, {"id": "Norican", "text": "Norican", "data-google": "true"}, {
            "id": "Nosifer",
            "text": "Nosifer",
            "data-google": "true"
        }, {"id": "Nothing You Could Do", "text": "Nothing You Could Do", "data-google": "true"}, {
            "id": "Noticia Text",
            "text": "Noticia Text",
            "data-google": "true"
        }, {"id": "Noto Sans", "text": "Noto Sans", "data-google": "true"}, {
            "id": "Noto Serif",
            "text": "Noto Serif",
            "data-google": "true"
        }, {"id": "Nova Cut", "text": "Nova Cut", "data-google": "true"}, {
            "id": "Nova Flat",
            "text": "Nova Flat",
            "data-google": "true"
        }, {"id": "Nova Mono", "text": "Nova Mono", "data-google": "true"}, {
            "id": "Nova Oval",
            "text": "Nova Oval",
            "data-google": "true"
        }, {"id": "Nova Round", "text": "Nova Round", "data-google": "true"}, {
            "id": "Nova Script",
            "text": "Nova Script",
            "data-google": "true"
        }, {"id": "Nova Slim", "text": "Nova Slim", "data-google": "true"}, {
            "id": "Nova Square",
            "text": "Nova Square",
            "data-google": "true"
        }, {"id": "Numans", "text": "Numans", "data-google": "true"}, {
            "id": "Nunito",
            "text": "Nunito",
            "data-google": "true"
        }, {"id": "Nunito Sans", "text": "Nunito Sans", "data-google": "true"}, {
            "id": "Odor Mean Chey",
            "text": "Odor Mean Chey",
            "data-google": "true"
        }, {"id": "Offside", "text": "Offside", "data-google": "true"}, {
            "id": "Old Standard TT",
            "text": "Old Standard TT",
            "data-google": "true"
        }, {"id": "Oldenburg", "text": "Oldenburg", "data-google": "true"}, {
            "id": "Oleo Script",
            "text": "Oleo Script",
            "data-google": "true"
        }, {
            "id": "Oleo Script Swash Caps",
            "text": "Oleo Script Swash Caps",
            "data-google": "true"
        }, {"id": "Open Sans", "text": "Open Sans", "data-google": "true"}, {
            "id": "Open Sans Condensed",
            "text": "Open Sans Condensed",
            "data-google": "true"
        }, {"id": "Oranienbaum", "text": "Oranienbaum", "data-google": "true"}, {
            "id": "Orbitron",
            "text": "Orbitron",
            "data-google": "true"
        }, {"id": "Oregano", "text": "Oregano", "data-google": "true"}, {
            "id": "Orienta",
            "text": "Orienta",
            "data-google": "true"
        }, {"id": "Original Surfer", "text": "Original Surfer", "data-google": "true"}, {
            "id": "Oswald",
            "text": "Oswald",
            "data-google": "true"
        }, {"id": "Over the Rainbow", "text": "Over the Rainbow", "data-google": "true"}, {
            "id": "Overlock",
            "text": "Overlock",
            "data-google": "true"
        }, {"id": "Overlock SC", "text": "Overlock SC", "data-google": "true"}, {
            "id": "Overpass",
            "text": "Overpass",
            "data-google": "true"
        }, {"id": "Overpass Mono", "text": "Overpass Mono", "data-google": "true"}, {
            "id": "Ovo",
            "text": "Ovo",
            "data-google": "true"
        }, {"id": "Oxygen", "text": "Oxygen", "data-google": "true"}, {
            "id": "Oxygen Mono",
            "text": "Oxygen Mono",
            "data-google": "true"
        }, {"id": "PT Mono", "text": "PT Mono", "data-google": "true"}, {
            "id": "PT Sans",
            "text": "PT Sans",
            "data-google": "true"
        }, {"id": "PT Sans Caption", "text": "PT Sans Caption", "data-google": "true"}, {
            "id": "PT Sans Narrow",
            "text": "PT Sans Narrow",
            "data-google": "true"
        }, {"id": "PT Serif", "text": "PT Serif", "data-google": "true"}, {
            "id": "PT Serif Caption",
            "text": "PT Serif Caption",
            "data-google": "true"
        }, {"id": "Pacifico", "text": "Pacifico", "data-google": "true"}, {
            "id": "Padauk",
            "text": "Padauk",
            "data-google": "true"
        }, {"id": "Palanquin", "text": "Palanquin", "data-google": "true"}, {
            "id": "Palanquin Dark",
            "text": "Palanquin Dark",
            "data-google": "true"
        }, {"id": "Pangolin", "text": "Pangolin", "data-google": "true"}, {
            "id": "Paprika",
            "text": "Paprika",
            "data-google": "true"
        }, {"id": "Parisienne", "text": "Parisienne", "data-google": "true"}, {
            "id": "Passero One",
            "text": "Passero One",
            "data-google": "true"
        }, {"id": "Passion One", "text": "Passion One", "data-google": "true"}, {
            "id": "Pathway Gothic One",
            "text": "Pathway Gothic One",
            "data-google": "true"
        }, {"id": "Patrick Hand", "text": "Patrick Hand", "data-google": "true"}, {
            "id": "Patrick Hand SC",
            "text": "Patrick Hand SC",
            "data-google": "true"
        }, {"id": "Pattaya", "text": "Pattaya", "data-google": "true"}, {
            "id": "Patua One",
            "text": "Patua One",
            "data-google": "true"
        }, {"id": "Pavanam", "text": "Pavanam", "data-google": "true"}, {
            "id": "Paytone One",
            "text": "Paytone One",
            "data-google": "true"
        }, {"id": "Peddana", "text": "Peddana", "data-google": "true"}, {
            "id": "Peralta",
            "text": "Peralta",
            "data-google": "true"
        }, {"id": "Permanent Marker", "text": "Permanent Marker", "data-google": "true"}, {
            "id": "Petit Formal Script",
            "text": "Petit Formal Script",
            "data-google": "true"
        }, {"id": "Petrona", "text": "Petrona", "data-google": "true"}, {
            "id": "Philosopher",
            "text": "Philosopher",
            "data-google": "true"
        }, {"id": "Piedra", "text": "Piedra", "data-google": "true"}, {
            "id": "Pinyon Script",
            "text": "Pinyon Script",
            "data-google": "true"
        }, {"id": "Pirata One", "text": "Pirata One", "data-google": "true"}, {
            "id": "Plaster",
            "text": "Plaster",
            "data-google": "true"
        }, {"id": "Play", "text": "Play", "data-google": "true"}, {
            "id": "Playball",
            "text": "Playball",
            "data-google": "true"
        }, {"id": "Playfair Display", "text": "Playfair Display", "data-google": "true"}, {
            "id": "Playfair Display SC",
            "text": "Playfair Display SC",
            "data-google": "true"
        }, {"id": "Podkova", "text": "Podkova", "data-google": "true"}, {
            "id": "Poiret One",
            "text": "Poiret One",
            "data-google": "true"
        }, {"id": "Poller One", "text": "Poller One", "data-google": "true"}, {
            "id": "Poly",
            "text": "Poly",
            "data-google": "true"
        }, {"id": "Pompiere", "text": "Pompiere", "data-google": "true"}, {
            "id": "Pontano Sans",
            "text": "Pontano Sans",
            "data-google": "true"
        }, {"id": "Poor Story", "text": "Poor Story", "data-google": "true"}, {
            "id": "Poppins",
            "text": "Poppins",
            "data-google": "true"
        }, {"id": "Port Lligat Sans", "text": "Port Lligat Sans", "data-google": "true"}, {
            "id": "Port Lligat Slab",
            "text": "Port Lligat Slab",
            "data-google": "true"
        }, {"id": "Pragati Narrow", "text": "Pragati Narrow", "data-google": "true"}, {
            "id": "Prata",
            "text": "Prata",
            "data-google": "true"
        }, {"id": "Preahvihear", "text": "Preahvihear", "data-google": "true"}, {
            "id": "Press Start 2P",
            "text": "Press Start 2P",
            "data-google": "true"
        }, {"id": "Pridi", "text": "Pridi", "data-google": "true"}, {
            "id": "Princess Sofia",
            "text": "Princess Sofia",
            "data-google": "true"
        }, {"id": "Prociono", "text": "Prociono", "data-google": "true"}, {
            "id": "Prompt",
            "text": "Prompt",
            "data-google": "true"
        }, {"id": "Prosto One", "text": "Prosto One", "data-google": "true"}, {
            "id": "Proza Libre",
            "text": "Proza Libre",
            "data-google": "true"
        }, {"id": "Puritan", "text": "Puritan", "data-google": "true"}, {
            "id": "Purple Purse",
            "text": "Purple Purse",
            "data-google": "true"
        }, {"id": "Quando", "text": "Quando", "data-google": "true"}, {
            "id": "Quantico",
            "text": "Quantico",
            "data-google": "true"
        }, {"id": "Quattrocento", "text": "Quattrocento", "data-google": "true"}, {
            "id": "Quattrocento Sans",
            "text": "Quattrocento Sans",
            "data-google": "true"
        }, {"id": "Questrial", "text": "Questrial", "data-google": "true"}, {
            "id": "Quicksand",
            "text": "Quicksand",
            "data-google": "true"
        }, {"id": "Quintessential", "text": "Quintessential", "data-google": "true"}, {
            "id": "Qwigley",
            "text": "Qwigley",
            "data-google": "true"
        }, {"id": "Racing Sans One", "text": "Racing Sans One", "data-google": "true"}, {
            "id": "Radley",
            "text": "Radley",
            "data-google": "true"
        }, {"id": "Rajdhani", "text": "Rajdhani", "data-google": "true"}, {
            "id": "Rakkas",
            "text": "Rakkas",
            "data-google": "true"
        }, {"id": "Raleway", "text": "Raleway", "data-google": "true"}, {
            "id": "Raleway Dots",
            "text": "Raleway Dots",
            "data-google": "true"
        }, {"id": "Ramabhadra", "text": "Ramabhadra", "data-google": "true"}, {
            "id": "Ramaraja",
            "text": "Ramaraja",
            "data-google": "true"
        }, {"id": "Rambla", "text": "Rambla", "data-google": "true"}, {
            "id": "Rammetto One",
            "text": "Rammetto One",
            "data-google": "true"
        }, {"id": "Ranchers", "text": "Ranchers", "data-google": "true"}, {
            "id": "Rancho",
            "text": "Rancho",
            "data-google": "true"
        }, {"id": "Ranga", "text": "Ranga", "data-google": "true"}, {
            "id": "Rasa",
            "text": "Rasa",
            "data-google": "true"
        }, {"id": "Rationale", "text": "Rationale", "data-google": "true"}, {
            "id": "Ravi Prakash",
            "text": "Ravi Prakash",
            "data-google": "true"
        }, {"id": "Redressed", "text": "Redressed", "data-google": "true"}, {
            "id": "Reem Kufi",
            "text": "Reem Kufi",
            "data-google": "true"
        }, {"id": "Reenie Beanie", "text": "Reenie Beanie", "data-google": "true"}, {
            "id": "Revalia",
            "text": "Revalia",
            "data-google": "true"
        }, {"id": "Rhodium Libre", "text": "Rhodium Libre", "data-google": "true"}, {
            "id": "Ribeye",
            "text": "Ribeye",
            "data-google": "true"
        }, {"id": "Ribeye Marrow", "text": "Ribeye Marrow", "data-google": "true"}, {
            "id": "Righteous",
            "text": "Righteous",
            "data-google": "true"
        }, {"id": "Risque", "text": "Risque", "data-google": "true"}, {
            "id": "Roboto",
            "text": "Roboto",
            "data-google": "true"
        }, {"id": "Roboto Condensed", "text": "Roboto Condensed", "data-google": "true"}, {
            "id": "Roboto Mono",
            "text": "Roboto Mono",
            "data-google": "true"
        }, {"id": "Roboto Slab", "text": "Roboto Slab", "data-google": "true"}, {
            "id": "Rochester",
            "text": "Rochester",
            "data-google": "true"
        }, {"id": "Rock Salt", "text": "Rock Salt", "data-google": "true"}, {
            "id": "Rokkitt",
            "text": "Rokkitt",
            "data-google": "true"
        }, {"id": "Romanesco", "text": "Romanesco", "data-google": "true"}, {
            "id": "Ropa Sans",
            "text": "Ropa Sans",
            "data-google": "true"
        }, {"id": "Rosario", "text": "Rosario", "data-google": "true"}, {
            "id": "Rosarivo",
            "text": "Rosarivo",
            "data-google": "true"
        }, {"id": "Rouge Script", "text": "Rouge Script", "data-google": "true"}, {
            "id": "Rozha One",
            "text": "Rozha One",
            "data-google": "true"
        }, {"id": "Rubik", "text": "Rubik", "data-google": "true"}, {
            "id": "Rubik Mono One",
            "text": "Rubik Mono One",
            "data-google": "true"
        }, {"id": "Ruda", "text": "Ruda", "data-google": "true"}, {
            "id": "Rufina",
            "text": "Rufina",
            "data-google": "true"
        }, {"id": "Ruge Boogie", "text": "Ruge Boogie", "data-google": "true"}, {
            "id": "Ruluko",
            "text": "Ruluko",
            "data-google": "true"
        }, {"id": "Rum Raisin", "text": "Rum Raisin", "data-google": "true"}, {
            "id": "Ruslan Display",
            "text": "Ruslan Display",
            "data-google": "true"
        }, {"id": "Russo One", "text": "Russo One", "data-google": "true"}, {
            "id": "Ruthie",
            "text": "Ruthie",
            "data-google": "true"
        }, {"id": "Rye", "text": "Rye", "data-google": "true"}, {
            "id": "Sacramento",
            "text": "Sacramento",
            "data-google": "true"
        }, {"id": "Sahitya", "text": "Sahitya", "data-google": "true"}, {
            "id": "Sail",
            "text": "Sail",
            "data-google": "true"
        }, {"id": "Saira", "text": "Saira", "data-google": "true"}, {
            "id": "Saira Condensed",
            "text": "Saira Condensed",
            "data-google": "true"
        }, {
            "id": "Saira Extra Condensed",
            "text": "Saira Extra Condensed",
            "data-google": "true"
        }, {"id": "Saira Semi Condensed", "text": "Saira Semi Condensed", "data-google": "true"}, {
            "id": "Salsa",
            "text": "Salsa",
            "data-google": "true"
        }, {"id": "Sanchez", "text": "Sanchez", "data-google": "true"}, {
            "id": "Sancreek",
            "text": "Sancreek",
            "data-google": "true"
        }, {"id": "Sansita", "text": "Sansita", "data-google": "true"}, {
            "id": "Sarala",
            "text": "Sarala",
            "data-google": "true"
        }, {"id": "Sarina", "text": "Sarina", "data-google": "true"}, {
            "id": "Sarpanch",
            "text": "Sarpanch",
            "data-google": "true"
        }, {"id": "Satisfy", "text": "Satisfy", "data-google": "true"}, {
            "id": "Scada",
            "text": "Scada",
            "data-google": "true"
        }, {"id": "Scheherazade", "text": "Scheherazade", "data-google": "true"}, {
            "id": "Schoolbell",
            "text": "Schoolbell",
            "data-google": "true"
        }, {"id": "Scope One", "text": "Scope One", "data-google": "true"}, {
            "id": "Seaweed Script",
            "text": "Seaweed Script",
            "data-google": "true"
        }, {"id": "Secular One", "text": "Secular One", "data-google": "true"}, {
            "id": "Sedgwick Ave",
            "text": "Sedgwick Ave",
            "data-google": "true"
        }, {"id": "Sedgwick Ave Display", "text": "Sedgwick Ave Display", "data-google": "true"}, {
            "id": "Sevillana",
            "text": "Sevillana",
            "data-google": "true"
        }, {"id": "Seymour One", "text": "Seymour One", "data-google": "true"}, {
            "id": "Shadows Into Light",
            "text": "Shadows Into Light",
            "data-google": "true"
        }, {"id": "Shadows Into Light Two", "text": "Shadows Into Light Two", "data-google": "true"}, {
            "id": "Shanti",
            "text": "Shanti",
            "data-google": "true"
        }, {"id": "Share", "text": "Share", "data-google": "true"}, {
            "id": "Share Tech",
            "text": "Share Tech",
            "data-google": "true"
        }, {"id": "Share Tech Mono", "text": "Share Tech Mono", "data-google": "true"}, {
            "id": "Shojumaru",
            "text": "Shojumaru",
            "data-google": "true"
        }, {"id": "Short Stack", "text": "Short Stack", "data-google": "true"}, {
            "id": "Shrikhand",
            "text": "Shrikhand",
            "data-google": "true"
        }, {"id": "Siemreap", "text": "Siemreap", "data-google": "true"}, {
            "id": "Sigmar One",
            "text": "Sigmar One",
            "data-google": "true"
        }, {"id": "Signika", "text": "Signika", "data-google": "true"}, {
            "id": "Signika Negative",
            "text": "Signika Negative",
            "data-google": "true"
        }, {"id": "Simonetta", "text": "Simonetta", "data-google": "true"}, {
            "id": "Sintony",
            "text": "Sintony",
            "data-google": "true"
        }, {"id": "Sirin Stencil", "text": "Sirin Stencil", "data-google": "true"}, {
            "id": "Six Caps",
            "text": "Six Caps",
            "data-google": "true"
        }, {"id": "Skranji", "text": "Skranji", "data-google": "true"}, {
            "id": "Slabo 13px",
            "text": "Slabo 13px",
            "data-google": "true"
        }, {"id": "Slabo 27px", "text": "Slabo 27px", "data-google": "true"}, {
            "id": "Slackey",
            "text": "Slackey",
            "data-google": "true"
        }, {"id": "Smokum", "text": "Smokum", "data-google": "true"}, {
            "id": "Smythe",
            "text": "Smythe",
            "data-google": "true"
        }, {"id": "Sniglet", "text": "Sniglet", "data-google": "true"}, {
            "id": "Snippet",
            "text": "Snippet",
            "data-google": "true"
        }, {"id": "Snowburst One", "text": "Snowburst One", "data-google": "true"}, {
            "id": "Sofadi One",
            "text": "Sofadi One",
            "data-google": "true"
        }, {"id": "Sofia", "text": "Sofia", "data-google": "true"}, {
            "id": "Song Myung",
            "text": "Song Myung",
            "data-google": "true"
        }, {"id": "Sonsie One", "text": "Sonsie One", "data-google": "true"}, {
            "id": "Sorts Mill Goudy",
            "text": "Sorts Mill Goudy",
            "data-google": "true"
        }, {"id": "Source Code Pro", "text": "Source Code Pro", "data-google": "true"}, {
            "id": "Source Sans Pro",
            "text": "Source Sans Pro",
            "data-google": "true"
        }, {"id": "Source Serif Pro", "text": "Source Serif Pro", "data-google": "true"}, {
            "id": "Space Mono",
            "text": "Space Mono",
            "data-google": "true"
        }, {"id": "Special Elite", "text": "Special Elite", "data-google": "true"}, {
            "id": "Spectral",
            "text": "Spectral",
            "data-google": "true"
        }, {"id": "Spectral SC", "text": "Spectral SC", "data-google": "true"}, {
            "id": "Spicy Rice",
            "text": "Spicy Rice",
            "data-google": "true"
        }, {"id": "Spinnaker", "text": "Spinnaker", "data-google": "true"}, {
            "id": "Spirax",
            "text": "Spirax",
            "data-google": "true"
        }, {"id": "Squada One", "text": "Squada One", "data-google": "true"}, {
            "id": "Sree Krushnadevaraya",
            "text": "Sree Krushnadevaraya",
            "data-google": "true"
        }, {"id": "Sriracha", "text": "Sriracha", "data-google": "true"}, {
            "id": "Stalemate",
            "text": "Stalemate",
            "data-google": "true"
        }, {"id": "Stalinist One", "text": "Stalinist One", "data-google": "true"}, {
            "id": "Stardos Stencil",
            "text": "Stardos Stencil",
            "data-google": "true"
        }, {
            "id": "Stint Ultra Condensed",
            "text": "Stint Ultra Condensed",
            "data-google": "true"
        }, {"id": "Stint Ultra Expanded", "text": "Stint Ultra Expanded", "data-google": "true"}, {
            "id": "Stoke",
            "text": "Stoke",
            "data-google": "true"
        }, {"id": "Strait", "text": "Strait", "data-google": "true"}, {
            "id": "Stylish",
            "text": "Stylish",
            "data-google": "true"
        }, {"id": "Sue Ellen Francisco", "text": "Sue Ellen Francisco", "data-google": "true"}, {
            "id": "Suez One",
            "text": "Suez One",
            "data-google": "true"
        }, {"id": "Sumana", "text": "Sumana", "data-google": "true"}, {
            "id": "Sunflower",
            "text": "Sunflower",
            "data-google": "true"
        }, {"id": "Sunshiney", "text": "Sunshiney", "data-google": "true"}, {
            "id": "Supermercado One",
            "text": "Supermercado One",
            "data-google": "true"
        }, {"id": "Sura", "text": "Sura", "data-google": "true"}, {
            "id": "Suranna",
            "text": "Suranna",
            "data-google": "true"
        }, {"id": "Suravaram", "text": "Suravaram", "data-google": "true"}, {
            "id": "Suwannaphum",
            "text": "Suwannaphum",
            "data-google": "true"
        }, {"id": "Swanky and Moo Moo", "text": "Swanky and Moo Moo", "data-google": "true"}, {
            "id": "Syncopate",
            "text": "Syncopate",
            "data-google": "true"
        }, {"id": "Tajawal", "text": "Tajawal", "data-google": "true"}, {
            "id": "Tangerine",
            "text": "Tangerine",
            "data-google": "true"
        }, {"id": "Taprom", "text": "Taprom", "data-google": "true"}, {
            "id": "Tauri",
            "text": "Tauri",
            "data-google": "true"
        }, {"id": "Taviraj", "text": "Taviraj", "data-google": "true"}, {
            "id": "Teko",
            "text": "Teko",
            "data-google": "true"
        }, {"id": "Telex", "text": "Telex", "data-google": "true"}, {
            "id": "Tenali Ramakrishna",
            "text": "Tenali Ramakrishna",
            "data-google": "true"
        }, {"id": "Tenor Sans", "text": "Tenor Sans", "data-google": "true"}, {
            "id": "Text Me One",
            "text": "Text Me One",
            "data-google": "true"
        }, {"id": "The Girl Next Door", "text": "The Girl Next Door", "data-google": "true"}, {
            "id": "Tienne",
            "text": "Tienne",
            "data-google": "true"
        }, {"id": "Tillana", "text": "Tillana", "data-google": "true"}, {
            "id": "Timmana",
            "text": "Timmana",
            "data-google": "true"
        }, {"id": "Tinos", "text": "Tinos", "data-google": "true"}, {
            "id": "Titan One",
            "text": "Titan One",
            "data-google": "true"
        }, {"id": "Titillium Web", "text": "Titillium Web", "data-google": "true"}, {
            "id": "Trade Winds",
            "text": "Trade Winds",
            "data-google": "true"
        }, {"id": "Trirong", "text": "Trirong", "data-google": "true"}, {
            "id": "Trocchi",
            "text": "Trocchi",
            "data-google": "true"
        }, {"id": "Trochut", "text": "Trochut", "data-google": "true"}, {
            "id": "Trykker",
            "text": "Trykker",
            "data-google": "true"
        }, {"id": "Tulpen One", "text": "Tulpen One", "data-google": "true"}, {
            "id": "Ubuntu",
            "text": "Ubuntu",
            "data-google": "true"
        }, {"id": "Ubuntu Condensed", "text": "Ubuntu Condensed", "data-google": "true"}, {
            "id": "Ubuntu Mono",
            "text": "Ubuntu Mono",
            "data-google": "true"
        }, {"id": "Ultra", "text": "Ultra", "data-google": "true"}, {
            "id": "Uncial Antiqua",
            "text": "Uncial Antiqua",
            "data-google": "true"
        }, {"id": "Underdog", "text": "Underdog", "data-google": "true"}, {
            "id": "Unica One",
            "text": "Unica One",
            "data-google": "true"
        }, {"id": "UnifrakturCook", "text": "UnifrakturCook", "data-google": "true"}, {
            "id": "UnifrakturMaguntia",
            "text": "UnifrakturMaguntia",
            "data-google": "true"
        }, {"id": "Unkempt", "text": "Unkempt", "data-google": "true"}, {
            "id": "Unlock",
            "text": "Unlock",
            "data-google": "true"
        }, {"id": "Unna", "text": "Unna", "data-google": "true"}, {
            "id": "VT323",
            "text": "VT323",
            "data-google": "true"
        }, {"id": "Vampiro One", "text": "Vampiro One", "data-google": "true"}, {
            "id": "Varela",
            "text": "Varela",
            "data-google": "true"
        }, {"id": "Varela Round", "text": "Varela Round", "data-google": "true"}, {
            "id": "Vast Shadow",
            "text": "Vast Shadow",
            "data-google": "true"
        }, {"id": "Vesper Libre", "text": "Vesper Libre", "data-google": "true"}, {
            "id": "Vibur",
            "text": "Vibur",
            "data-google": "true"
        }, {"id": "Vidaloka", "text": "Vidaloka", "data-google": "true"}, {
            "id": "Viga",
            "text": "Viga",
            "data-google": "true"
        }, {"id": "Voces", "text": "Voces", "data-google": "true"}, {
            "id": "Volkhov",
            "text": "Volkhov",
            "data-google": "true"
        }, {"id": "Vollkorn", "text": "Vollkorn", "data-google": "true"}, {
            "id": "Vollkorn SC",
            "text": "Vollkorn SC",
            "data-google": "true"
        }, {"id": "Voltaire", "text": "Voltaire", "data-google": "true"}, {
            "id": "Waiting for the Sunrise",
            "text": "Waiting for the Sunrise",
            "data-google": "true"
        }, {"id": "Wallpoet", "text": "Wallpoet", "data-google": "true"}, {
            "id": "Walter Turncoat",
            "text": "Walter Turncoat",
            "data-google": "true"
        }, {"id": "Warnes", "text": "Warnes", "data-google": "true"}, {
            "id": "Wellfleet",
            "text": "Wellfleet",
            "data-google": "true"
        }, {"id": "Wendy One", "text": "Wendy One", "data-google": "true"}, {
            "id": "Wire One",
            "text": "Wire One",
            "data-google": "true"
        }, {"id": "Work Sans", "text": "Work Sans", "data-google": "true"}, {
            "id": "Yanone Kaffeesatz",
            "text": "Yanone Kaffeesatz",
            "data-google": "true"
        }, {"id": "Yantramanav", "text": "Yantramanav", "data-google": "true"}, {
            "id": "Yatra One",
            "text": "Yatra One",
            "data-google": "true"
        }, {"id": "Yellowtail", "text": "Yellowtail", "data-google": "true"}, {
            "id": "Yeon Sung",
            "text": "Yeon Sung",
            "data-google": "true"
        }, {"id": "Yeseva One", "text": "Yeseva One", "data-google": "true"}, {
            "id": "Yesteryear",
            "text": "Yesteryear",
            "data-google": "true"
        }, {"id": "Yrsa", "text": "Yrsa", "data-google": "true"}, {
            "id": "Zeyada",
            "text": "Zeyada",
            "data-google": "true"
        }, {"id": "Zilla Slab", "text": "Zilla Slab", "data-google": "true"}, {
            "id": "Zilla Slab Highlight",
            "text": "Zilla Slab Highlight",
            "data-google": "true"
        }]
    },
    "stdfonts": {
        "text": "Standard Fonts",
        "children": [{
            "id": "Arial, Helvetica, sans-serif",
            "text": "Arial, Helvetica, sans-serif",
            "data-google": "false"
        }, {
            "id": "'Arial Black', Gadget, sans-serif",
            "text": "'Arial Black', Gadget, sans-serif",
            "data-google": "false"
        }, {
            "id": "'Bookman Old Style', serif",
            "text": "'Bookman Old Style', serif",
            "data-google": "false"
        }, {
            "id": "'Comic Sans MS', cursive",
            "text": "'Comic Sans MS', cursive",
            "data-google": "false"
        }, {"id": "Courier, monospace", "text": "Courier, monospace", "data-google": "false"}, {
            "id": "Garamond, serif",
            "text": "Garamond, serif",
            "data-google": "false"
        }, {
            "id": "Georgia, serif",
            "text": "Georgia, serif",
            "data-google": "false"
        }, {
            "id": "Impact, Charcoal, sans-serif",
            "text": "Impact, Charcoal, sans-serif",
            "data-google": "false"
        }, {
            "id": "'Lucida Console', Monaco, monospace",
            "text": "'Lucida Console', Monaco, monospace",
            "data-google": "false"
        }, {
            "id": "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
            "text": "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
            "data-google": "false"
        }, {
            "id": "'MS Sans Serif', Geneva, sans-serif",
            "text": "'MS Sans Serif', Geneva, sans-serif",
            "data-google": "false"
        }, {
            "id": "'MS Serif', 'New York', sans-serif",
            "text": "'MS Serif', 'New York', sans-serif",
            "data-google": "false"
        }, {
            "id": "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
            "text": "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
            "data-google": "false"
        }, {
            "id": "Tahoma,Geneva, sans-serif",
            "text": "Tahoma,Geneva, sans-serif",
            "data-google": "false"
        }, {
            "id": "'Times New Roman', Times,serif",
            "text": "'Times New Roman', Times,serif",
            "data-google": "false"
        }, {
            "id": "'Trebuchet MS', Helvetica, sans-serif",
            "text": "'Trebuchet MS', Helvetica, sans-serif",
            "data-google": "false"
        }, {"id": "Verdana, Geneva, sans-serif", "text": "Verdana, Geneva, sans-serif", "data-google": "false"}]
    },
    "folds": {
        "preloader-setting": "show",
        "preloader-animation": "show",
        "preloader-fontawesome": "hide",
        "preloader-image": "hide",
        "preloader-color": "show",
        "preloader-bgcolor": "show",
        "preloader-size": "show",
        "backtotop-icon": "show",
        "backtotop-icon-size": "show",
        "backtotop-icon-color": "show",
        "backtotop-icon-bgcolor": "show",
        "backtotop-icon-shape": "show",
        "backtotop-on-mobile": "show",
        "layout-background": "hide",
        "smooth-scroll-speed": "show",
        "header-layout": "show",
        "header-mode": "show",
        "header-horizontal-menu-mode": "show",
        "header-stacked-menu-mode": "hide",
        "header-sidebar-menu-mode": "hide",
        "header-block-1-type": "show",
        "header-block-1-sidebar": "hide",
        "header-block-1-custom": "hide",
        "header-block-2-type": "hide",
        "header-block-2-sidebar": "hide",
        "header-block-2-custom": "hide",
        "header-menu": "show",
        "header-menu-level": "show",
        "header-mobile-menu": "show",
        "header-mobile-menu-level": "show",
        "header-absolute": "show",
        "section-logo": "show",
        "logo-type": "show",
        "default-logo": "show",
        "mobile-logo": "show",
        "sidebar-logo": "hide",
        "logo-text": "hide",
        "tag-line": "hide",
        "section-sticky-header": "show",
        "enable-sticky": "show",
        "sticky-menu-mode": "show",
        "sticky-logo": "show",
        "sticky-desktop": "show",
        "sticky-tablet": "show",
        "sticky-mobile": "show",
        "section-offcanvas-menu": "show",
        "enable-offcanvas": "show",
        "offcanvas-sidebar": "show",
        "offcanvas-togglevisibility": "show",
        "offcanvas-panelwidth": "show",
        "offcanvas-animation": "show",
        "offcanvas-direction": "show",
        "section-dropdown-animation": "show",
        "dropdown-animation-type": "show",
        "dropdown-animation-effect": "show",
        "dropdown-arrow": "show",
        "dropdown-trigger": "show",
        "topsidebar-column-2": "show",
        "topsidebar-column-3": "hide",
        "topsidebar-column-4": "hide",
        "topsidebar-column-5": "hide",
        "typography-body-option": "show",
        "typography-menu-option": "hide",
        "typography-submenu-option": "hide",
        "typography-h1-option": "show",
        "typography-h2-option": "show",
        "typography-h3-option": "hide",
        "typography-h4-option": "hide",
        "typography-h5-option": "hide",
        "typography-h6-option": "hide",
        "typography-top-bar-option": "hide",
        "typography-footer-option": "hide",
        "miscellaneous-logo": "show",
        "miscellaneous-content": "show",
        "miscellaneous-coming-soon-countdown-date": "show",
        "miscellaneous-coming-soon-social": "show",
        "miscellaneous-background-setting": "show",
        "404-background-color": "hide",
        "404-background": "hide",
        "404-background-video": "hide",
        "footer-column-2": "show",
        "footer-column-3": "show",
        "footer-column-4": "show",
        "footer-column-5": "hide"
    },
    "fieldsHidden": ["preloader-fontawesome", "preloader-image", "layout-background", "header-stacked-menu-mode", "header-sidebar-menu-mode", "header-block-1-sidebar", "header-block-1-custom", "header-block-2-type", "header-block-2-sidebar", "header-block-2-custom", "sidebar-logo", "logo-text", "tag-line", "topsidebar-column-3", "topsidebar-column-4", "topsidebar-column-5", "typography-menu-option", "typography-submenu-option", "typography-h3-option", "typography-h4-option", "typography-h5-option", "typography-h6-option", "typography-top-bar-option", "typography-footer-option", "404-background-color", "404-background", "404-background-video", "footer-column-5"],
    "options": {
        "last_tab": "0",
        "preloader": "1",
        "preloader-setting": "animations",
        "preloader-animation": "circle",
        "preloader-fontawesome": "spiner",
        "preloader-image": {
            "background-repeat": "",
            "background-size": "",
            "background-attachment": "",
            "background-position": "",
            "background-image": "",
            "media": {"id": "", "height": "", "width": "", "thumbnail": ""}
        },
        "preloader-color": {"color": "", "alpha": "1", "rgba": ""},
        "preloader-bgcolor": {"color": "", "alpha": "1", "rgba": ""},
        "preloader-size": "40",
        "backtotop": "1",
        "backtotop-icon": "fas fa-arrow-up",
        "backtotop-icon-size": "20",
        "backtotop-icon-color": {"color": "", "alpha": "1", "rgba": ""},
        "backtotop-icon-bgcolor": {"color": "", "alpha": "1", "rgba": ""},
        "backtotop-icon-shape": "circle",
        "backtotop-on-mobile": "1",
        "layout-theme": "wide",
        "layout-background": {
            "background-color": "",
            "background-repeat": "",
            "background-size": "",
            "background-attachment": "",
            "background-position": "",
            "background-image": "",
            "media": {"id": "", "height": "", "width": "", "thumbnail": ""}
        },
        "enable-smooth-scroll": "1",
        "smooth-scroll-speed": "300",
        "body-background-color": {"color": "#f7f8fd", "alpha": "1", "rgba": "rgba(247,248,253,1)"},
        "body-text-color": {"color": "#666666", "alpha": "1", "rgba": "rgba(102,102,102,1)"},
        "body-heading-color": {"color": "#373f83", "alpha": "1", "rgba": "rgba(55,63,131,1)"},
        "body-link-color": {"color": "#373f83", "alpha": "1", "rgba": "rgba(55,63,131,1)"},
        "body-link-hover-color": {"color": "#5a83e4", "alpha": "1", "rgba": "rgba(90,131,228,1)"},
        "header-bg": {"color": "", "alpha": "", "rgba": ""},
        "header-text-color": {"color": "#ffffff", "alpha": "1", "rgba": "rgba(255,255,255,1)"},
        "header-heading-color": {"color": "", "alpha": "1", "rgba": ""},
        "header-link-color": {"color": "", "alpha": "1", "rgba": ""},
        "header-link-hover-color": {"color": "", "alpha": "1", "rgba": ""},
        "header-logo-text-color": {"color": "", "alpha": "1", "rgba": ""},
        "header-logo-text-tagline-color": {"color": "", "alpha": "1", "rgba": ""},
        "topbar-bordercolor": {"color": "", "alpha": "1", "rgba": ""},
        "main-menu-link-color": {"color": "#ffffff", "alpha": "1", "rgba": "rgba(255,255,255,1)"},
        "main-menu-link-active-color": {"color": "#5a83e4", "alpha": "1", "rgba": "rgba(90,131,228,1)"},
        "main-menu-link-hover-color": {"color": "#5a83e4", "alpha": "1", "rgba": "rgba(90,131,228,1)"},
        "sidebar-separate-color": {"color": "", "alpha": "1", "rgba": ""},
        "sticky-header-background-color": {"color": "#000000", "alpha": "0.7", "rgba": "rgba(0,0,0,0.7)"},
        "sticky-menu-link-color": {"color": "#ffffff", "alpha": "1", "rgba": "rgba(255,255,255,1)"},
        "sticky-menu-link-active-color": {"color": "#5a83e4", "alpha": "1", "rgba": "rgba(90,131,228,1)"},
        "sticky-menu-link-hover-color": {"color": "#5a83e4", "alpha": "1", "rgba": "rgba(90,131,228,1)"},
        "sticky-off-canvas-button-color": {"color": "", "alpha": "1", "rgba": ""},
        "dropdown-menu-background-color": {"color": "", "alpha": "1", "rgba": ""},
        "dropdown-menu-link-color": {"color": "", "alpha": "1", "rgba": ""},
        "dropdown-menu-link-active-color": {"color": "", "alpha": "1", "rgba": ""},
        "dropdown-menu-active-bg-color": {"color": "", "alpha": "1", "rgba": ""},
        "dropdown-menu-link-hover-color": {"color": "", "alpha": "1", "rgba": ""},
        "dropdown-menu-hover-bg-color": {"color": "", "alpha": "1", "rgba": ""},
        "dropdown-menu-megamenu-border-color": {"color": "", "alpha": "1", "rgba": ""},
        "off-canvas-button-color-close": {"color": "#ffffff", "alpha": "1", "rgba": "rgba(255,255,255,1)"},
        "off-canvas-background-color": {"color": "", "alpha": "1", "rgba": ""},
        "off-canvas-mobile-menu-text-color": {"color": "", "alpha": "1", "rgba": ""},
        "off-canvas-mobile-menu-link-color": {"color": "", "alpha": "1", "rgba": ""},
        "off-canvas-button-color": {"color": "#ffffff", "alpha": "1", "rgba": "rgba(255,255,255,1)"},
        "off-canvas-link-active-color": {"color": "", "alpha": "1", "rgba": ""},
        "off-canvas-mobile-menu-active-bg-color": {"color": "", "alpha": "1", "rgba": ""},
        "enable-header": "1",
        "header-layout": "boxed",
        "header-mode": "horizontal",
        "header-horizontal-menu-mode": "right",
        "header-stacked-menu-mode": "center",
        "header-sidebar-menu-mode": "left",
        "header-block-1-type": "blank",
        "header-block-1-sidebar": "",
        "header-block-1-custom": "",
        "header-block-2-type": "blank",
        "header-block-2-sidebar": "",
        "header-block-2-custom": "",
        "header-menu": "primary",
        "header-menu-level": "0",
        "header-mobile-menu": "header",
        "header-mobile-menu-level": "0",
        "header-absolute": "",
        "logo-type": "1",
        "default-logo": {
            "url": "http:\/\/wordpress.templaza.com\/duongtv\/templaza-framework\/wp-content\/uploads\/2020\/07\/logo.png",
            "id": "72",
            "height": "27",
            "width": "105",
            "thumbnail": "http:\/\/wordpress.templaza.com\/duongtv\/templaza-framework\/wp-content\/uploads\/2020\/07\/logo.png",
            "title": "logo",
            "caption": "",
            "alt": "",
            "description": ""
        },
        "mobile-logo": {
            "url": "",
            "id": "",
            "height": "",
            "width": "",
            "thumbnail": "",
            "title": "",
            "caption": "",
            "alt": "",
            "description": ""
        },
        "sidebar-logo": {
            "url": "",
            "id": "",
            "height": "",
            "width": "",
            "thumbnail": "",
            "title": "",
            "caption": "",
            "alt": "",
            "description": ""
        },
        "logo-text": "",
        "tag-line": "",
        "enable-sticky": "1",
        "sticky-menu-mode": "right",
        "sticky-logo": {
            "url": "http:\/\/wordpress.templaza.com\/duongtv\/templaza-framework\/wp-content\/uploads\/2020\/07\/logo.png",
            "id": "72",
            "height": "27",
            "width": "105",
            "thumbnail": "http:\/\/wordpress.templaza.com\/duongtv\/templaza-framework\/wp-content\/uploads\/2020\/07\/logo.png",
            "title": "logo",
            "caption": "",
            "alt": "",
            "description": ""
        },
        "sticky-desktop": "sticky",
        "sticky-tablet": "static",
        "sticky-mobile": "static",
        "enable-offcanvas": "1",
        "offcanvas-sidebar": "sidebar-1",
        "offcanvas-togglevisibility": "d-block",
        "offcanvas-panelwidth": "320px",
        "offcanvas-animation": "st-effect-1",
        "offcanvas-direction": "1",
        "dropdown-animation-type": "fade",
        "dropdown-animation-effect": "fade-down",
        "dropdown-arrow": "1",
        "dropdown-trigger": "1",
        "topsidebar-layout": "wide",
        "topsidebar-columns": "2",
        "topsidebar-column-1": {"width": "3", "sidebar": "", "custom_class": ""},
        "topsidebar-column-2": {"width": "9", "sidebar": "", "custom_class": ""},
        "topsidebar-column-3": {"width": "1", "sidebar": "", "custom_class": ""},
        "topsidebar-column-4": {"width": "1", "sidebar": "", "custom_class": ""},
        "topsidebar-column-5": {"width": "1", "sidebar": "", "custom_class": ""},
        "typography-body": "custom",
        "typography-body-option": {
            "font-family": "Saira",
            "font-options": "",
            "google": "1",
            "font-backup": "Arial, Helvetica, sans-serif",
            "font-weight": "400",
            "font-style": "",
            "subsets": "",
            "text-transform": "none",
            "font-size": "16px",
            "line-height": "16px",
            "letter-spacing": "0px"
        },
        "typography-menu": "default",
        "typography-menu-option": {
            "font-family": "Nunito",
            "font-options": "",
            "google": "1",
            "font-backup": "Arial, Helvetica, sans-serif",
            "font-weight": "400",
            "font-style": "",
            "subsets": "",
            "text-transform": "none",
            "font-size": "",
            "line-height": "",
            "letter-spacing": "0px"
        },
        "typography-submenu": "default",
        "typography-submenu-option": {
            "font-family": "",
            "font-options": "",
            "google": "1",
            "font-backup": "Arial, Helvetica, sans-serif",
            "font-weight": "400",
            "font-style": "",
            "subsets": "",
            "text-transform": "none",
            "font-size": "",
            "line-height": "",
            "letter-spacing": "0"
        },
        "typography-h1": "custom",
        "typography-h1-option": {
            "font-family": "Saira Semi Condensed",
            "font-options": "",
            "google": "1",
            "font-backup": "Arial, Helvetica, sans-serif",
            "font-weight": "800",
            "font-style": "",
            "subsets": "",
            "text-transform": "none",
            "font-size": "50px",
            "line-height": "50px",
            "letter-spacing": "0px",
            "color": "#000"
        },
        "typography-h2": "custom",
        "typography-h2-option": {
            "font-family": "Saira Semi Condensed",
            "font-options": "",
            "google": "1",
            "font-backup": "Arial, Helvetica, sans-serif",
            "font-weight": "800",
            "font-style": "",
            "subsets": "",
            "text-transform": "none",
            "font-size": "55px",
            "line-height": "55px",
            "letter-spacing": "0px",
            "color": "#373f83"
        },
        "typography-h3": "default",
        "typography-h3-option": {
            "font-family": "Arial, Helvetica, sans-serif",
            "font-options": "",
            "google": "1",
            "font-backup": "Arial, Helvetica, sans-serif",
            "font-weight": "500",
            "font-style": "",
            "subsets": "",
            "text-transform": "none",
            "font-size": "",
            "line-height": "",
            "letter-spacing": "0",
            "color": "#000"
        },
        "typography-h4": "default",
        "typography-h4-option": {
            "font-family": "Arial, Helvetica, sans-serif",
            "font-options": "",
            "google": "1",
            "font-backup": "Arial, Helvetica, sans-serif",
            "font-weight": "500",
            "font-style": "",
            "subsets": "",
            "text-transform": "none",
            "font-size": "",
            "line-height": "",
            "letter-spacing": "0",
            "color": "#000"
        },
        "typography-h5": "default",
        "typography-h5-option": {
            "font-family": "Arial, Helvetica, sans-serif",
            "font-options": "",
            "google": "1",
            "font-backup": "Arial, Helvetica, sans-serif",
            "font-weight": "500",
            "font-style": "",
            "subsets": "",
            "text-transform": "none",
            "font-size": "",
            "line-height": "",
            "letter-spacing": "0",
            "color": "#000"
        },
        "typography-h6": "default",
        "typography-h6-option": {
            "font-family": "Arial, Helvetica, sans-serif",
            "font-options": "",
            "google": "1",
            "font-backup": "Arial, Helvetica, sans-serif",
            "font-weight": "500",
            "font-style": "",
            "subsets": "",
            "text-transform": "none",
            "font-size": "",
            "line-height": "",
            "letter-spacing": "0",
            "color": "#000"
        },
        "typography-top-bar": "default",
        "typography-top-bar-option": {
            "font-family": "Arial, Helvetica, sans-serif",
            "font-options": "",
            "google": "1",
            "font-backup": "Arial, Helvetica, sans-serif",
            "font-weight": "",
            "font-style": "",
            "subsets": "",
            "text-transform": "none",
            "font-size": "",
            "line-height": "",
            "letter-spacing": "0px",
            "color": "#000"
        },
        "typography-footer": "default",
        "typography-footer-option": {
            "font-family": "",
            "font-options": "",
            "google": "1",
            "font-backup": "Arial, Helvetica, sans-serif",
            "font-weight": "400",
            "font-style": "",
            "subsets": "",
            "text-transform": "none",
            "font-size": "",
            "line-height": "",
            "letter-spacing": "0",
            "color": "#000"
        },
        "miscellaneous-development-mode": "1",
        "miscellaneous-logo": {
            "url": "",
            "id": "",
            "height": "",
            "width": "",
            "thumbnail": "",
            "title": "",
            "caption": "",
            "alt": "",
            "description": ""
        },
        "miscellaneous-content": "",
        "miscellaneous-coming-soon-countdown-date": "",
        "miscellaneous-coming-soon-social": "1",
        "miscellaneous-background-setting": "",
        "404-content": "",
        "404-call-to-action": "Go Home",
        "404-background-setting": "0",
        "404-background-color": {"color": "", "alpha": "1", "rgba": ""},
        "404-background": {
            "background-color": "",
            "background-repeat": "",
            "background-size": "",
            "background-attachment": "",
            "background-position": "",
            "background-image": "",
            "media": {"id": "", "height": "", "width": "", "thumbnail": ""}
        },
        "404-background-video": {
            "url": "",
            "id": "",
            "height": "",
            "width": "",
            "thumbnail": "",
            "title": "",
            "caption": "",
            "alt": "",
            "description": ""
        },
        "favicon": {
            "url": "",
            "id": "",
            "height": "",
            "width": "",
            "thumbnail": "",
            "title": "",
            "caption": "",
            "alt": "",
            "description": ""
        },
        "trackingcode-editor": "",
        "beforehead-editor": "",
        "beforebody-editor": "",
        "customcss-editor": "",
        "customcss-files": "",
        "customjs": "",
        "customjs-files": "",
        "footer-layout": "wide",
        "footer-columns": "4",
        "footer-column-1": {"width": "2", "sidebar": "sidebar-1", "custom_class": ""},
        "footer-column-2": {"width": "2", "sidebar": "sidebar-1", "custom_class": ""},
        "footer-column-3": {"width": "3", "sidebar": "sidebar-1", "custom_class": ""},
        "footer-column-4": {"width": "5", "sidebar": "sidebar-2", "custom_class": ""},
        "footer-column-5": {"width": "1", "sidebar": "", "custom_class": ""},
        "layout": "[{\"type\":\"section\",\"params\":[{\"name\":\"title\",\"value\":\"Section Title\"},{\"name\":\"customclass\",\"value\":\"\"}],\"elements\":[{\"title\":\"Row\",\"type\":\"row\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}],\"elements\":[{\"type\":\"column\",\"size\":6,\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}],\"elements\":[{\"type\":\"header\",\"icon\":\"el el-tasks\",\"title\":\"Header\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]},{\"type\":\"contact\",\"icon\":\"far fa-address-card\",\"title\":\"Contact\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]}]},{\"type\":\"column\",\"size\":6,\"params\":[],\"elements\":[{\"type\":\"header\",\"icon\":\"el el-tasks\",\"title\":\"Header\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]},{\"type\":\"contact\",\"icon\":\"far fa-address-card\",\"title\":\"Contact\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]}]}]},{\"title\":\"Row 2\",\"type\":\"row\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}],\"elements\":[{\"type\":\"column\",\"size\":4,\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}],\"elements\":[{\"type\":\"header\",\"icon\":\"el el-tasks\",\"title\":\"Header\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]},{\"type\":\"contact\",\"icon\":\"far fa-address-card\",\"title\":\"Contact\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]},{\"type\":\"copyright\",\"icon\":\"far fa-copyright\",\"title\":\"Copyright\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]}]},{\"type\":\"column\",\"size\":4,\"params\":[],\"elements\":[{\"type\":\"header\",\"icon\":\"el el-tasks\",\"title\":\"Header\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]},{\"type\":\"contact\",\"icon\":\"far fa-address-card\",\"title\":\"Contact\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]}]},{\"type\":\"column\",\"size\":4,\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}],\"elements\":[{\"type\":\"header\",\"icon\":\"el el-tasks\",\"title\":\"Header\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]},{\"type\":\"contact\",\"icon\":\"far fa-address-card\",\"title\":\"Contact\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]},{\"type\":\"copyright\",\"icon\":\"far fa-copyright\",\"title\":\"Copyright\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]}]}]}]},{\"type\":\"section\",\"params\":[{\"name\":\"title\",\"value\":\"Section Title\"},{\"name\":\"customclass\",\"value\":\"\"}],\"elements\":[{\"title\":\"Row\",\"type\":\"row\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}],\"elements\":[{\"type\":\"column\",\"size\":8,\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}],\"elements\":[{\"type\":\"header\",\"icon\":\"el el-tasks\",\"title\":\"Header\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]},{\"type\":\"contact\",\"icon\":\"far fa-address-card\",\"title\":\"Contact\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]}]},{\"type\":\"column\",\"size\":4,\"params\":[],\"elements\":[{\"type\":\"header\",\"icon\":\"el el-tasks\",\"title\":\"Header\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]},{\"type\":\"contact\",\"icon\":\"far fa-address-card\",\"title\":\"Contact\",\"params\":[{\"name\":\"customid\",\"value\":\"\"},{\"name\":\"customclass\",\"value\":\"\"}]}]}]}]}]",
        "section-logo": "",
        "section-sticky-header": "",
        "section-offcanvas-menu": "",
        "section-dropdown-animation": "",
        "section-end": "",
        "redux_options_object": "",
        "redux_import_export": ""
    },
    "defaults": {
        "preloader": true,
        "preloader-setting": "animations",
        "preloader-animation": "circle",
        "preloader-fontawesome": "spiner",
        "preloader-size": "40",
        "backtotop": true,
        "backtotop-icon": "fas fa-arrow-up",
        "backtotop-icon-size": 20,
        "backtotop-icon-color": "#000",
        "backtotop-icon-shape": "circle",
        "backtotop-on-mobile": true,
        "layout-theme": "wide",
        "enable-smooth-scroll": "1",
        "smooth-scroll-speed": "300",
        "enable-header": true,
        "header-layout": "wide",
        "header-mode": "horizontal",
        "header-horizontal-menu-mode": "left",
        "header-stacked-menu-mode": "center",
        "header-sidebar-menu-mode": "left",
        "header-block-1-type": "blank",
        "header-block-1-sidebar": "",
        "header-block-2-type": "blank",
        "header-block-2-sidebar": "",
        "header-block-2-custom": {"blank": "Blank", "custom": "Custom HTML"},
        "header-menu": "header",
        "header-menu-level": 0,
        "header-mobile-menu": "header",
        "header-mobile-menu-level": 0,
        "header-absolute": false,
        "logo-type": true,
        "enable-sticky": true,
        "sticky-menu-mode": "left",
        "sticky-desktop": "sticky",
        "sticky-tablet": "static",
        "sticky-mobile": "static",
        "enable-offcanvas": false,
        "offcanvas-sidebar": "",
        "offcanvas-togglevisibility": "d-block",
        "offcanvas-panelwidth": "320px",
        "offcanvas-animation": "st-effect-1",
        "offcanvas-direction": true,
        "dropdown-animation-type": "fade",
        "dropdown-animation-effect": "fade-down",
        "dropdown-arrow": true,
        "dropdown-trigger": true,
        "topsidebar-layout": "wide",
        "topsidebar-columns": "2",
        "topsidebar-column-1": {"width": "3", "type": "social"},
        "topsidebar-column-2": {"width": "9", "type": "contact"},
        "topsidebar-column-3": {"type": {"social": "Social", "contact": "Contact"}},
        "topsidebar-column-4": {"type": {"social": "Social", "contact": "Contact"}},
        "topsidebar-column-5": {"type": {"social": "Social", "contact": "Contact"}},
        "typography-body": "default",
        "typography-body-option": {
            "color": "#000",
            "font-weight": "400",
            "letter-spacing": "0",
            "text-transform": "none",
            "font-family": "Nunito",
            "font-backup": "Arial, Helvetica, sans-serif"
        },
        "typography-menu": "default",
        "typography-menu-option": {
            "color": "#000",
            "font-weight": "400",
            "letter-spacing": "0",
            "text-transform": "none",
            "font-family": "Nunito",
            "font-backup": "Arial, Helvetica, sans-serif"
        },
        "typography-submenu": "default",
        "typography-submenu-option": {
            "color": "#000",
            "font-weight": "400",
            "letter-spacing": "0",
            "text-transform": "none",
            "font-backup": "Arial, Helvetica, sans-serif"
        },
        "typography-h1": "default",
        "typography-h1-option": {
            "color": "#000",
            "font-weight": "700",
            "letter-spacing": "0",
            "text-transform": "none",
            "font-family": "Arial, Helvetica, sans-serif",
            "font-backup": "Arial, Helvetica, sans-serif"
        },
        "typography-h2": "default",
        "typography-h2-option": {
            "color": "#000",
            "font-weight": "600",
            "letter-spacing": "0",
            "text-transform": "none",
            "font-family": "Arial, Helvetica, sans-serif",
            "font-backup": "Arial, Helvetica, sans-serif"
        },
        "typography-h3": "default",
        "typography-h3-option": {
            "color": "#000",
            "font-weight": "500",
            "letter-spacing": "0",
            "text-transform": "none",
            "font-family": "Arial, Helvetica, sans-serif",
            "font-backup": "Arial, Helvetica, sans-serif"
        },
        "typography-h4": "default",
        "typography-h4-option": {
            "color": "#000",
            "font-weight": "500",
            "letter-spacing": "0",
            "text-transform": "none",
            "font-family": "Arial, Helvetica, sans-serif",
            "font-backup": "Arial, Helvetica, sans-serif"
        },
        "typography-h5": "default",
        "typography-h5-option": {
            "color": "#000",
            "font-weight": "500",
            "letter-spacing": "0",
            "text-transform": "none",
            "font-family": "Arial, Helvetica, sans-serif",
            "font-backup": "Arial, Helvetica, sans-serif"
        },
        "typography-h6": "default",
        "typography-h6-option": {
            "color": "#000",
            "font-weight": "500",
            "letter-spacing": "0",
            "text-transform": "none",
            "font-family": "Arial, Helvetica, sans-serif",
            "font-backup": "Arial, Helvetica, sans-serif"
        },
        "typography-top-bar": "default",
        "typography-top-bar-option": {
            "color": "#000",
            "font-weight": "500",
            "letter-spacing": "0",
            "text-transform": "none",
            "font-family": "Arial, Helvetica, sans-serif",
            "font-backup": "Arial, Helvetica, sans-serif"
        },
        "typography-footer": "default",
        "typography-footer-option": {
            "color": "#000",
            "font-weight": "400",
            "letter-spacing": "0",
            "text-transform": "none",
            "font-backup": "Arial, Helvetica, sans-serif"
        },
        "miscellaneous-development-mode": true,
        "miscellaneous-coming-soon-social": true,
        "miscellaneous-background-setting": "",
        "404-content": "",
        "404-call-to-action": "Go Home",
        "404-background-setting": 0,
        "footer-layout": "wide",
        "footer-columns": "1",
        "footer-column-1": {"width": "12", "type": "copyright"},
        "footer-column-2": {"width": "6", "type": "sidebar"},
        "preloader-image": "",
        "preloader-color": "",
        "preloader-bgcolor": "",
        "backtotop-icon-bgcolor": "",
        "layout-background": "",
        "body-background-color": "",
        "body-text-color": "",
        "body-heading-color": "",
        "body-link-color": "",
        "body-link-hover-color": "",
        "header-bg": "",
        "header-text-color": "",
        "header-heading-color": "",
        "header-link-color": "",
        "header-link-hover-color": "",
        "header-logo-text-color": "",
        "header-logo-text-tagline-color": "",
        "topbar-bordercolor": "",
        "main-menu-link-color": "",
        "main-menu-link-active-color": "",
        "main-menu-link-hover-color": "",
        "sidebar-separate-color": "",
        "sticky-header-background-color": "",
        "sticky-menu-link-color": "",
        "sticky-menu-link-active-color": "",
        "sticky-menu-link-hover-color": "",
        "sticky-off-canvas-button-color": "",
        "dropdown-menu-background-color": "",
        "dropdown-menu-link-color": "",
        "dropdown-menu-link-active-color": "",
        "dropdown-menu-active-bg-color": "",
        "dropdown-menu-link-hover-color": "",
        "dropdown-menu-hover-bg-color": "",
        "dropdown-menu-megamenu-border-color": "",
        "off-canvas-button-color-close": "",
        "off-canvas-background-color": "",
        "off-canvas-mobile-menu-text-color": "",
        "off-canvas-mobile-menu-link-color": "",
        "off-canvas-button-color": "",
        "off-canvas-link-active-color": "",
        "off-canvas-mobile-menu-active-bg-color": "",
        "header-block-1-custom": "",
        "section-logo": "",
        "default-logo": "",
        "mobile-logo": "",
        "sidebar-logo": "",
        "logo-text": "",
        "tag-line": "",
        "section-sticky-header": "",
        "sticky-logo": "",
        "section-offcanvas-menu": "",
        "section-dropdown-animation": "",
        "section-end": "",
        "miscellaneous-logo": "",
        "miscellaneous-content": "",
        "miscellaneous-coming-soon-countdown-date": "",
        "404-background-color": "",
        "404-background": "",
        "404-background-video": "",
        "favicon": "",
        "trackingcode-editor": "",
        "beforehead-editor": "",
        "beforebody-editor": "",
        "customcss-editor": "",
        "customcss-files": "",
        "customjs": "",
        "customjs-files": "",
        "footer-column-3": "",
        "footer-column-4": "",
        "footer-column-5": "",
        "layout": "",
        "redux_options_object": "",
        "redux_import_export": "",
        "topsidebar-column-1-width": 1,
        "topsidebar-column-1-sidebar": "",
        "topsidebar-column-2-width": 1,
        "topsidebar-column-2-sidebar": "",
        "topsidebar-column-3-width": 1,
        "topsidebar-column-3-sidebar": "",
        "topsidebar-column-4-width": 1,
        "topsidebar-column-4-sidebar": "",
        "topsidebar-column-5-width": 1,
        "topsidebar-column-5-sidebar": "",
        "footer-column-1-width": 1,
        "footer-column-1-sidebar": "",
        "footer-column-2-width": 1,
        "footer-column-2-sidebar": "",
        "footer-column-3-width": 1,
        "footer-column-3-sidebar": "",
        "footer-column-4-width": 1,
        "footer-column-4-sidebar": "",
        "footer-column-5-width": 1,
        "footer-column-5-sidebar": ""
    },
    "args": {
        "save_pending": "You have changes that are not saved. Would you like to save them now?",
        "reset_confirm": "Are you sure? Resetting will lose all custom values.",
        "reset_section_confirm": "Are you sure? Resetting will lose all custom values in this section.",
        "import_section_confirm": "Your current options will be replaced with the values of this import. Would you like to proceed?",
        "preset_confirm": "Your current options will be replaced with the values of this preset. Would you like to proceed?",
        "please_wait": "Please Wait",
        "opt_name": "tzfrm_templaza-blank_opt",
        "slug": "tzfrm_options",
        "hints": {
            "icon": "icon-question-sign",
            "icon_position": "right",
            "icon_color": "lightgray",
            "icon_size": "normal",
            "tip_style": {"color": "light", "shadow": true, "rounded": false, "style": ""},
            "tip_position": {"my": "top left", "at": "bottom right"},
            "tip_effect": {
                "show": {"effect": "slide", "duration": "500", "event": "mouseover"},
                "hide": {"effect": "slide", "duration": "500", "event": "click mouseleave"}
            }
        },
        "disable_save_warn": false,
        "class": "templaza-framework-options",
        "ajax_save": true,
        "menu_search": "admin.php?page=tzfrm_options&tab="
    },
    "ajax": {
        "console": "There was an error saving. Here is the result of your action:",
        "alert": "There was a problem with your action. Please try again or reload the page."
    },
    "rAds": "<span data-id=\"1\" class=\"mgv1_1\"><script type=\"text\/javascript\">(function(){if (mysa_mgv1_1) return; var ma = document.createElement(\"script\"); ma.type = \"text\/javascript\"; ma.async = true; ma.src = \"http:\/\/wordpress.templaza.com\/duongtv\/templaza-framework\/wp-admin\/admin-ajax.php?action=redux_p&nonce=2c3b15f1af&url=http%3A%2F%2Flook.redux.io%2Fapi%2Findex.php%3Fjs%26g%261%26v%3D2&proxy=http%3A%2F%2Fwordpress.templaza.com%2Fduongtv%2Ftemplaza-framework%2Fwp-admin%2Fadmin-ajax.php%3Faction%3Dredux_p%26nonce%3D2c3b15f1af%26url%3D\"; var s = document.getElementsByTagName(\"script\")[0]; s.parentNode.insertBefore(ma, s) })();var mysa_mgv1_1=true;<\/script><\/span>"
};