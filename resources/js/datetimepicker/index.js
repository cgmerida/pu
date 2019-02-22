import * as $ from "jquery";

import "pc-bootstrap4-datetimepicker";

import "pc-bootstrap4-datetimepicker/src/sass/bootstrap-datetimepicker-build.css";

export default (function () {
    $.extend($.fn.datetimepicker.defaults, {
        locale: "es",
        format: "YYYY-MM-DD HH:mm:ss",
        sideBySide: true,
        useCurrent: false
    });
})();