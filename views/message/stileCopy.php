<?php


<div class="panel_content"> 
    <div class="toolbar"> 
        <span class="content"> 
            <span class="item save_and_close" data-bind="visible: typeof saveAndClose === 'function',  click: function () { if (saveAndClose) { saveAndClose(); } }, customTooltip: saveAndCloseTooltip">
                <span class="icon">                    
                </span>
            </span> 
            <span class="item new_window" data-bind="customTooltip: 'MAILWEBCLIENT/ACTION_OPEN_IN_NEW_WINDOW', click: openInNewWindow">
                <span class="icon">                    
                </span> 
            </span>
                    <span class="item minimize" data-bind="visible: typeof minimize === 'function',  click: function () { if (minimize) { minimize(); } }, customTooltip: 'MAILWEBCLIENT/ACTION_MINIMIZE'">
                        <span class="icon">
                
                </span> 
            </span> <!-- /ko --> <!-- ko foreach: toolbarControllers --> <!-- ko template: { name: $data.ViewTemplate, data: $data} -->
            <span class="item buttons"> <span class="button command unavailable command-disabled disable disabled" data-bind="command: sendCommand" id="selenium_compose_send_button"> 
                    <span class="text" data-bind="i18n: {'key': 'MAILWEBCLIENT/ACTION_SEND'}">Отправить</span> 
                </span> 
            </span> <!-- /ko -->  <!-- ko template: { name: $data.ViewTemplate, data: $data} -->
            <span class="item save command enable" data-bind="command: saveCommand, visible: visible">
                <span class="icon" data-bind="customTooltip: 'MAILWEBCLIENT/ACTION_SAVE'"></span> 
                <span class="text" data-bind="i18n: {'key': 'MAILWEBCLIENT/ACTION_SAVE'}">Сохранить</span>
            </span> <!-- /ko -->  <!-- ko template: { name: $data.ViewTemplate, data: $data} -->
            <span class="item importance" data-bind="dropdown: {'control': false}"> 
                <span class="icon" data-bind="customTooltip: 'MAILWEBCLIENT/ACTION_CHANGE_IMPORTANCE'"></span>
                <span class="text" data-bind="i18n: {'key': 'MAILWEBCLIENT/ACTION_CHANGE_IMPORTANCE'}">Приоритет</span> 
                <span class="icon arrow"></span> 
                <span class="dropdown"> 
                    <span class="dropdown_helper" style="left: 0px;"> 
                        <span class="dropdown_arrow" style="left: 0px;"><span></span></span> <span class="dropdown_content">
                            <span class="item" data-bind="click: function () {selectedImportance(Enums.Importance.Low);},    i18n: {'key': 'MAILWEBCLIENT/ACTION_SET_LOW_IMPORTANCE'},    css: {'selected': selectedImportance() === Enums.Importance.Low}">Низкий</span> <span class="item selected" data-bind="click: function () {selectedImportance(Enums.Importance.Normal);},    i18n: {'key': 'MAILWEBCLIENT/ACTION_SET_NORMAL_IMPORTANCE'},    css: {'selected': selectedImportance() === Enums.Importance.Normal}">Обычный</span> 
                            <span class="item" data-bind="click: function () {selectedImportance(Enums.Importance.High);},    i18n: {'key': 'MAILWEBCLIENT/ACTION_SET_HIGH_IMPORTANCE'},    css: {'selected': selectedImportance() === Enums.Importance.High}">Высокий</span> 
                        </span> 
                    </span> 
                </span> 
            </span> <!-- /ko -->  <!-- ko template: { name: $data.ViewTemplate, data: $data} -->
            <span class="item sensitivity" data-bind="dropdown: {'control': false}">
                <span class="icon" data-bind="customTooltip: 'MAILSENSITIVITYWEBCLIENTPLUGIN/ACTION_CHANGE_SENSITIVITY'"></span> 
                <span class="text" data-bind="i18n: {'key': 'MAILSENSITIVITYWEBCLIENTPLUGIN/ACTION_CHANGE_SENSITIVITY'}">Пометка</span> 
                <span class="icon arrow"></span>
                <span class="dropdown"> 
                    <span class="dropdown_helper" style="left: 0px;"> 
                        <span class="dropdown_arrow" style="left: 0px;"><span></span></span> <span class="dropdown_content"> 
                            <span class="item selected" data-bind="click: function () {selectedSensitivity(Enums.Sensitivity.Nothing);},    i18n: {'key': 'MAILSENSITIVITYWEBCLIENTPLUGIN/ACTION_SET_NOTHING'},    css: {'selected': selectedSensitivity() === Enums.Sensitivity.Nothing}">Обычное</span> <span class="item" data-bind="click: function () {selectedSensitivity(Enums.Sensitivity.Confidential);},    i18n: {'key': 'MAILSENSITIVITYWEBCLIENTPLUGIN/ACTION_SET_CONFIDENTIAL'},    css: {'selected': selectedSensitivity() === Enums.Sensitivity.Confidential}">Конфиденциальное</span>
                            <span class="item" data-bind="click: function () {selectedSensitivity(Enums.Sensitivity.Private);},    i18n: {'key': 'MAILSENSITIVITYWEBCLIENTPLUGIN/ACTION_SET_PRIVATE'},    css: {'selected': selectedSensitivity() === Enums.Sensitivity.Private}">Частное
                            </span>
                            <span class="item" data-bind="click: function () {selectedSensitivity(Enums.Sensitivity.Personal);},    i18n: {'key': 'MAILSENSITIVITYWEBCLIENTPLUGIN/ACTION_SET_PERSONAL'},    css: {'selected': selectedSensitivity() === Enums.Sensitivity.Personal}">Личное
                            </span> 
                        </span> 
                    </span>
                </span>
            </span>
            <label class="item confirmation"> 
                <span class="custom_checkbox" data-bind="css: {'checked': sendReadingConfirmation}"> 
                    <span class="icon"></span>
                    <input type="checkbox" data-bind="checked: sendReadingConfirmation"> 
                </span> 
                <span class="text" data-bind="i18n: {'key': 'MAILWEBCLIENT/LABEL_READING_CONFIRMATION'}">Подтверждение прочтения
                </span> 
            </label> <!-- /ko -->  <!-- ko template: { name: $data.ViewTemplate, data: $data} -->
<span class="item pgp command unavailable command-disabled disable disabled" data-bind="command: openPgpCommand, visible: visibleDoPgpButton" style="display: none;"> <span class="icon"></span> <span class="text" data-bind="i18n: {'key': 'OPENPGPWEBCLIENT/ACTION_SIGN_ENCRYPT'}">PGP Шифрование</span> </span> <span class="item pgp" data-bind="click: undoPgp, visible: visibleUndoPgpButton" style="display: none;"> <span class="icon"></span> <span class="text" data-bind="i18n: {'key': 'OPENPGPWEBCLIENT/ACTION_UNDO_PGP'}">Отменить PGP</span> 
</span> <!-- /ko -->  <!-- ko template: { name: $data.ViewTemplate, data: $data} -->
<span class="item save command enable" data-bind="command: saveTemplateCommand, visible: visible" style="display: none;">
    <span class="icon" data-bind="customTooltip: 'MAILWEBCLIENT/ACTION_SAVE_TEMPLATE'">        
    </span>
<span class="text" data-bind="i18n: {'key': 'MAILWEBCLIENT/ACTION_SAVE_TEMPLATE'}">Сохранить шаблон</span> 
</span> <!-- /ko --> <!-- /ko --> 
</span> 
</div> 
<div class="middle_bar"> 
<div class="panels" data-bind="splitterFlex: {name: 'compose_attachments', sizes: [80, 20]}, initDom: splitterDom"> 
<div class="panel message_panel" style="width: calc(80% - 0px);"> 
<div class="panel_content"> <div class="middle_bar"> 
<div class="panel_top" data-bind="initDom: messageFields"> 
<span class="table-compressor" data-bind="click: changeHeadersCompressed, css: { 'compressed': headersCompressed }"> 
<span class="arrow"></span>
</span> 
<div class="notice" data-bind="visible: bDemo, i18n: {'key': 'MAILWEBCLIENT/INFO_SEND_EMAIL_TO_DEMO_ONLY'}" style="display: none;">Из соображений безопасности, разрешается отправка только демо-аккаунтам.
</div> 
<table class="fields"> 
<tbody>
<tr class="from" data-bind="visible: visibleFrom() &amp;&amp; !headersCompressed()" style="display: none;">
<td class="label">
<span data-bind="i18n: {'key': 'MAILWEBCLIENT/LABEL_FROM'}">От
</span>: </td> <td class="value">
<select class="input" tabindex="1" data-bind="foreach: senderList, value: selectedSender"> 
<option data-bind="text: fullEmail, value: id" value="21057800000">user31754@demo.afterlogic.com
</option> 
</select> 
</td> 
</tr>
<tr class="to"> 
<td class="label"> 
<span data-bind="i18n: {'key': 'MAILWEBCLIENT/LABEL_TO'}">Кому
</span>: </td> <td class="value">
<table>
<tbody>
<tr>
<td class="value" style="width: 100%;" id="selenium_compose_toaddr">
<div class="input inputosaurus"> 
    <div class="disable_mask" data-bind="visible: disableHeadersEdit" style="display: none;">
    </div>
<div data-bind="customScrollbar: {x: false}" class="scroll-wrap"> 
<div class="scroll-inner ui-droppable" style="overflow: hidden scroll; margin-right: 0px;"> 
<ul class="inputosaurus-container" style="padding: 3px; width: auto;">
<li class="inputosaurus-input inputosaurus-required">
<span class="icon">
                    </span> 
<span class="text" data-bind="i18n: {'key': 'MAILWEBCLIENT/ACTION_ATTACH_FROM_COMPUTER'}">Загрузка с вашего компьютера
</span> 
<label style="position: absolute; background-color: rgb(255, 255, 255); right: 0px; top: 0px; left: 0px; bottom: 0px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;">
<input type="file" tabindex="-1" hidefocus="hidefocus" style="position: absolute; left: -9999px;" multiple="">
</label>
</span> 
<span class="uploader_button files" data-bind="visible: bAllowFiles, click: onShowFilesPopupClick" style="display: none;"> 
<span class="icon" data-bind="customTooltip: 'MAILWEBCLIENT/ACTION_ATTACH_FROM_FILES'">    
                    </span> 
                    <span class="text" data-bind="i18n: {'key': 'MAILWEBCLIENT/ACTION_ATTACH_FROM_FILES'}">Загрузка из Файлов
                    </span> 
                </span> 
            </div> 
            <div class="panel_center scroll-wrap" data-bind="customScrollbar: {x: false}">
                <div class="scroll-inner" style="overflow: hidden scroll; margin-right: 0px;">
                    <div class="items_list"> <span class="list_notification" data-bind="i18n: {'key': 'MAILWEBCLIENT/INFO_TO_ATTACH_DRAGNDROP'}, visible: allowDragNDrop() &amp;&amp; notInlineAttachments().length === 0" style="">Чтобы прикрепить файлы, перетащите их сюда или используйте кнопки выше.
</span> 
<div class="attachments_container" data-bind="template: {name: 'CoreWebclient_FileView', foreach: notInlineAttachments}">
                                </div> 
</div> 
</div> 
<div class="customscroll-scrollbar customscroll-scrollbar-vertical">
<div>

                            </div>
                        </div>
                    </div> 
</div>
<div class="uploader_mask" data-bind="initDom: composeUploaderDropPlace,  
css: { 'over': uploaderDragOver, 'active': uploaderBodyDragOver }"> 
<div class="inner">    
                    </div> 
    </div> 
</div>
   </div> 
    </div> 
</div> 
</div>

