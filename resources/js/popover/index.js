import * as $ from "jquery";
import "bootstrap";

const popTemplate = `
<div class="popover" role="tooltip">
    <div class="arrow"></div>
    <h4 class="popover-header c-grey-900"></h4>
    <div class="popover-body"></div>
</div>`;

export default (function() {
    $.fn.popover.Constructor.Default.trigger = 'hover';
    $.fn.popover.Constructor.Default.placement = "top";
    $.fn.popover.Constructor.Default.container = "body";
    $.fn.popover.Constructor.Default.template = popTemplate;
    // ------------------------------------------------------
    // @Popover
    // ------------------------------------------------------

    $('[data-toggle="popover"]').popover({
        template: popTemplate
    });

    // ------------------------------------------------------
    // @Tooltips
    // ------------------------------------------------------

    $('[data-toggle="tooltip"]').tooltip();
})();
