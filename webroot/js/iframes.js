/**
 * @fileoverview Iframes Javascript
 * @author kotaro.hokada@gmail.com (Kotaro Hokada)
 */


/**
 * Iframes Javascript
 *
 * @param {string} controller name
 * @param {function(scope, http, sce, timeout)} Controller
 */
NetCommonsApp.controller('Iframes',
                         function($scope, $http, $sce, $timeout) {

      /**
       * plugin url
       *
       * @type {string}
       */
      $scope.PLUGIN_URL = '/iframes/iframes/';

      /**
       * iframe form url
       *
       * @type {string}
       */
      $scope.GET_IFRAME_FORM_URL = $scope.PLUGIN_URL + 'iframeForm/';

      /**
       * iframe post url
       *
       * @type {string}
       */
      $scope.POST_IFRAME_FORM_URL = $scope.PLUGIN_URL + 'iframeEdit/';

      /**
       * iframe frame setting form url
       *
       * @type {string}
       */
      $scope.GET_IFRAME_FRAME_SETTING_FORM_URL =
                           $scope.PLUGIN_URL + 'iframeFrameSettingForm/';

      /**
       * iframe post url
       *
       * @type {string}
       */
      $scope.POST_IFRAME_FRAME_SETTING_FORM_URL =
                           $scope.PLUGIN_URL + 'iframeFrameSettingEdit/';

      /**
       * iframe data
       *
       * @type {Object.<string>}
       */
      $scope.iframeData = {};

      /**
       * iframe Frame Setting data
       *
       * @type {Object.<string>}
       */
      $scope.iframeFrameSettingData = {};

      /**
       * frame id
       *
       * @type {number}
       */
      $scope.frameId = 0;

      /**
       * status code
       *
       * @type {{publish: integer,
       *          approval: integer,
       *          draft: integer,
       *          disapproval: integer}}
       */
      $scope.statusCode = {
        'publish': 1,
        'approval': 2,
        'draft': 3,
        'disapproval': 4
      };

      /**
       * input form of url
       *
       * @type {{value: string}}
       */
      $scope.iframeUrl = '';

      /**
       * input form of the height of the frame
       *
       * @type {{value: integer}}
       */
      $scope.iframeHeight = '';

      /**
       * checkbox of scroll bar
       *
       * @type {{value: boolean}}
       */
      $scope.iframeScrollBar = '';

      /**
       * checkbox of frame
       *
       * @type {{value: boolean}}
       */
      $scope.iframeFrame = '';

      /**
       * message of iframe edit
       *
       * @type {{value: boolean}}
       */
      $scope.iframeVisibleMsg = false;

      /**
       * message of iframe frame setting
       *
       * @type {{value: boolean}}
       */
      $scope.iframeFrameSettingVisibleMsg = false;

      /**
       * status label object
       *
       * @type {{publish: boolean,
       *          approval: boolean,
       *          draft: boolean,
       *          disapproval: boolean}}
       */
      $scope.label = {
        'publish': false,
        'approval': false,
        'draft': false,
        'disapproval': false
      };

      /**
       * button lock while sending post
       *
       * @type {boolean}
       */
      $scope.sendLock = false;

      /**
       * iframe input form attribute id
       *
       * @const
       */
      $scope.IFRAME_INPUT_FORM_ATTR_ID = '#nc-iframes-input-form-';

      /**
       * iframe input form attribute id
       *
       * @type {sring}
       */
      $scope.iframeInputFormAttrId = '';

      /**
       * iframe post form attribute id
       *
       * @const
       */
      $scope.IFRAME_POST_FORM_ATTR_ID = '#nc-iframes-post-form-';

      /**
       * iframe post form attribute id
       *
       * @type {sring}
       */
      $scope.iframePostFormAttrId = '';

      /**
       * iframe post form area attribute id
       *
       * @type {sring}
       */
      $scope.iframePostFormAreaAttrId = '';

      /**
       * iframe frame setting input form attribute id
       *
       * @const
       */
      $scope.IFRAME_FRAME_SETTING_INPUT_FORM_ATTR_ID =
                           '#nc-iframes-frame-setting-input-form-';

      /**
       * iframe frame setting input form attribute id
       *
       * @type {sring}
       */
      $scope.iframFrameSettingInputFormAttrId = '';

      /**
       * iframe frame setting post form attribute id
       *
       * @const
       */
      $scope.IFRAME_FRAME_SETTING_POST_FORM_ATTR_ID =
                           '#nc-iframes-frame-setting-post-form-';

      /**
       * iframe frame setting post form attribute id
       *
       * @type {sring}
       */
      $scope.iframeFrameSettingPostFormAttrId = '';

      /**
       * iframe result message attribute id
       *
       * @const
       */
      $scope.IFRAME_RESULT_MESSAGE_ATTR_ID =
                           '#nc-iframes-message-';

      /**
       * iframe result message attribute id
       *
       * @type {sring}
       */
      $scope.iframeResultMessageAttrId = '';

      /**
       * iframe frame setting result message attribute id
       *
       * @const
       */
      $scope.IFRAME_FRAME_SETTING_RESULT_MESSAGE_ATTR_ID =
                           '#nc-iframes-frame-setting-message-';

      /**
       * iframe frame setting result message attribute id
       *
       * @type {sring}
       */
      $scope.iframeFrameSettingResultMessageAttrId = '';

      /**
       * iframe id
       *
       * @const
       */
      $scope.IFRAME_ID = '#nc-iframes-iframe-';

      /**
       * iframe id
       *
       * @type {sring}
       */
      $scope.iframeId = '';

      /**
       * iframe element tag
       *
       * @type {sring}
       */
      $scope.iframeElementTag = '';

      /**
       * iframe manage modal id
       *
       * @const
       */
      $scope.IFRAME_MANAGE_MODAL_ID = '#nc-iframes-manage-modal-';

      /**
       * iframe manage modal id
       *
       * @type {sring}
       */
      $scope.iframeManageModalId = '';

      /**
       * iframe edit tab id
       *
       * @const
       */
      $scope.IFRAME_EDIT_TAB_ID = '#nc-iframes-edit-tab-';

      /**
       * iframe edit tab id
       *
       * @type {sring}
       */
      $scope.iframeEditTabId = '';

      /**
       * iframe edit id
       *
       * @const
       */
      $scope.IFRAME_EDIT_ID = '#nc-iframes-edit-';

      /**
       * iframe edit tab id
       *
       * @type {sring}
       */
      $scope.iframeEditId = '';

      /**
       * iframe frame setting id
       *
       * @const
       */
      $scope.IFRAME_FRAME_SETTING_TAB_ID = '#nc-iframes-frame-setting-tab-';

      /**
       * iframe frame setting id
       *
       * @type {sring}
       */
      $scope.iframeFrameSettingTabId = '';

      /**
       * iframe frame setting id
       *
       * @const
       */
      $scope.IFRAME_FRAME_SETTING_ID = '#nc-iframes-frame-setting-';

      /**
       * iframe frame setting id
       *
       * @type {sring}
       */
      $scope.iframeFrameSettingId = '';

      /**
       * Initialize
       *
       * @param {Object.<string>} iframe
       * @param {Object.<string>} iframeFrameSetting
       * @param {int} frameId
       * @return {void}
       */
      $scope.initialize = function(iframe, iframeFrameSetting, frameId) {
        //set iframe data
        $scope.iframeData = iframe;

        //set iframeFrameSetting data
        $scope.iframeFrameSettingData = iframeFrameSetting;

        //set frame id
        $scope.frameId = frameId;

        //set iframe input form attribute id
        $scope.iframeInputFormAttrId =
            $scope.IFRAME_INPUT_FORM_ATTR_ID + $scope.frameId;

        //set iframe post form attribute id
        $scope.iframePostFormAttrId =
            $scope.IFRAME_POST_FORM_ATTR_ID + $scope.frameId;

        //set iframe post form area attribute id
        $scope.iframePostFormAreaAttrId =
            $scope.IFRAME_POST_FORM_ATTR_ID + 'area-' + $scope.frameId;

        //set iframe frame setting input form attribute id
        $scope.iframFrameSettingInputFormAttrId =
            $scope.IFRAME_FRAME_SETTING_INPUT_FORM_ATTR_ID + $scope.frameId;

        //set iframe frame setting post form attribute id
        $scope.iframeFrameSettingPostFormAttrId =
            $scope.IFRAME_FRAME_SETTING_POST_FORM_ATTR_ID + $scope.frameId;

        //set iframe result message attribute id
        $scope.iframeResultMessageAttrId =
            $scope.IFRAME_RESULT_MESSAGE_ATTR_ID + $scope.frameId;

        //set iframe frame setting result message attribute id
        $scope.iframeFrameSettingResultMessageAttrId =
            $scope.IFRAME_FRAME_SETTING_RESULT_MESSAGE_ATTR_ID + $scope.frameId;

        //set iframe id
        $scope.iframeId = $scope.IFRAME_ID + $scope.frameId;

        //set iframe tag
        $scope.iframeElementTag = $scope.iframeId + ' iframe';

        //set iframe manage modal id
        $scope.iframeManageModalId =
            $scope.IFRAME_MANAGE_MODAL_ID + $scope.frameId;

        //set iframe edit tab id
        $scope.iframeEditTabId = $scope.IFRAME_EDIT_TAB_ID + $scope.frameId;

        //set iframe edit id
        $scope.iframeEditId = $scope.IFRAME_EDIT_ID + $scope.frameId;

        //set iframe frame setting tab id
        $scope.iframeFrameSettingTabId =
            $scope.IFRAME_FRAME_SETTING_TAB_ID + $scope.frameId;

        //set iframe frame setting id
        $scope.iframeFrameSettingId =
            $scope.IFRAME_FRAME_SETTING_ID + $scope.frameId;

        //call initializeMessageArea method
        $scope.initializeMessageArea();

        //initialize post form area
        $($scope.iframePostFormAreaAttrId).html(' ');
      };

      /**
       * Initialize
       *
       * @return {void}
       */
      $scope.initializeMessageArea = function() {
        //initialize edit message area
        $scope.iframeVisibleMsg = false;
        $($scope.iframeResultMessageAttrId)
            .addClass('hidden')
            .removeClass('alert-danger')
            .removeClass('alert-success');
        $($scope.iframeResultMessageAttrId + ' .message').html(' ');

        //initialize setting message area
        $scope.iframeFrameSettingVisibleMsg = false;
        $($scope.iframeFrameSettingResultMessageAttrId)
            .addClass('hidden')
            .removeClass('alert-danger')
            .removeClass('alert-success');
        $($scope.iframeFrameSettingResultMessageAttrId + ' .message').html(' ');
      };

      /**
       * show manage modal
       *
       * @return {void}
       */
      $scope.showManageModal = function() {
        //display manage modal
        $($scope.iframeManageModalId).modal({
          show: true,
          backdrop: 'static'
        });

        //call initializeManageModal method
        $scope.initializeManageModal();

        //set url into form
        $scope.iframeUrl = $scope.iframeData.Iframe.url;
      };

      /**
       * initialize manage modal
       *
       * @return {void}
       */
      $scope.initializeManageModal = function() {
        //activate the first tab
        $($scope.iframeEditTabId).addClass('active');
        $($scope.iframeEditId).addClass('active');

        //remove the active from other tab
        $($scope.iframeFrameSettingTabId).removeClass('active');
        $($scope.iframeFrameSettingId).removeClass('active');
      };

      /**
       * show modify display style
       *
       * @return {void}
       */
      $scope.showIframeFrameSetting = function() {
        //set the height of the frame into form
        $scope.iframeHeight = +($scope.iframeFrameSettingData
            .IframeFrameSetting.height);

        //set the scroll bar into form
        $scope.iframeScrollBar = Boolean(+($scope.iframeFrameSettingData
            .IframeFrameSetting.display_scrollbar));

        //set the frame into form
        $scope.iframeFrame = Boolean(+($scope.iframeFrameSettingData
            .IframeFrameSetting.display_frame));
      };

      /**
       * hide manage modal
       *
       * @return {void}
       */
      $scope.hideManageModal = function() {
        //hide manage modal
        $($scope.iframeManageModalId).modal('hide');
      };

      /**
       * post iframe
       *     1: Publish
       *     2: Approve
       *     3: Draft
       *     4: Disapprove
       *
       * @param {string} postStatus
       * @return {void}
       */
      $scope.postIframe = function(postStatus) {
        $scope.sendLock = true;
        $http.get($scope.GET_IFRAME_FORM_URL +
                $scope.frameId + '/' + Math.random())
          .success(function(data, status, headers, config) {
              //POST用のフォームセット
              $($scope.iframePostFormAreaAttrId).html(data);
              //ステータスのセット
              $($scope.iframePostFormAttrId +
                      ' select[name="data[Iframe][status]"]').val(postStatus);
              var postParams = {};
              //POSTフォームのシリアライズ
              var i = 0;
              var postSerialize =
                              $($scope.iframePostFormAttrId).serializeArray();
              var length = postSerialize.length;
              for (i; i < length; i++) {
                postParams[postSerialize[i]['name']] =
                                         postSerialize[i]['value'];
              }
              //入力フォームのシリアライズ
              var inputSerialize =
                              $($scope.iframeInputFormAttrId).serializeArray();
              var length = inputSerialize.length;
              for (i = 0; i < length; i++) {
                postParams[inputSerialize[i]['name']] =
                                         inputSerialize[i]['value'];
              }
              //登録情報をPOST
              $scope.sendIframe(postParams);
              //call hideManageModal method
              $scope.hideManageModal();
              $scope.sendLock = false;
            })
          .error(function(data, status, headers, config) {
              //keyの取得に失敗
              if (! data) { data = 'error'; }
              $scope.showIframeResultMessage('error', data);
              $scope.sendLock = false;
            });
      };

      /**
       * save iframe
       *
       * @param {Object.<string>} postParams
       * @return {void}
       */
      $scope.sendIframe = function(postParams) {
        $.ajax({
          method: 'POST' ,
          url: $scope.POST_IFRAME_FORM_URL +
              $scope.frameId + '/' + Math.random(),
          data: postParams,
          success: function(json, status, headers, config) {
            $scope.iframeData = json.data;
            //結果メッセージを表示
            $($scope.iframeResultMessageAttrId).removeClass('hidden');
            $scope.setIframeLatestData(json);
            $scope.showIframeResultMessage('success', json.message);
            $timeout(function() {
            }, 1000);
          },
          error: function(json, status, headers, config) {
            if (! json.message) {
              $scope.showIframeResultMessage('error', headers);
            } else {
              $scope.showIframeResultMessage('error', json.message);
            }
            $scope.sendLock = false;
          }
        });
      };

      /**
       * set iframe latest data
       *
       * @param {Object.<string>} json
       * @return {void}
       */
      $scope.setIframeLatestData = function(json) {
        var url = '';
        var height = 0;
        var display_scrollbar = false;
        var display_frame = false;
        $scope.contentsStatus = 0;
        if (json.data && json.data.Iframe.url &&
            json.data.Iframe.status) {

          url = json.data.Iframe.url;
          height = +($scope.iframeFrameSettingData.IframeFrameSetting.height);
          display_scrollbar = Boolean(+($scope.iframeFrameSettingData
                  .IframeFrameSetting.display_scrollbar));
          display_frame = Boolean(+($scope.iframeFrameSettingData
                  .IframeFrameSetting.display_frame));
          $scope.contentsStatus = +(json.data.Iframe.status);
        }
        //set latest data
        if ($($scope.iframeElementTag).size() === 0) {
          //create iframe tag if not created
          $($scope.iframeId).html($('<iframe>'));
        }
        $($scope.iframeElementTag).prop('src', url);
        $($scope.iframeElementTag).prop('height', height);
        $($scope.iframeElementTag).prop('width', '100%');
        if (display_scrollbar === true) {
          $($scope.iframeElementTag).prop('scrolling', 'yes');
        } else {
          $($scope.iframeElementTag).prop('scrolling', 'no');
        }
        if (display_frame === true) {
          $($scope.iframeElementTag).prop('frameborder', 1);
        } else {
          $($scope.iframeElementTag).prop('frameborder', 0);
        }
        //update status label
        $scope.initializeLabel();
        $scope.updateStatus($scope.contentsStatus);
      };

      /**
       * initialize label
       *
       * @return {void}
       */
      $scope.initializeLabel = function() {
        $scope.label.publish = false;
        $scope.label.approval = false;
        $scope.label.draft = false;
        $scope.label.disapproval = false;
      };

      /**
       * status
       *
       * @param {int} contentsStatus
       * @return {void}
       */
      $scope.updateStatus = function(contentsStatus) {
        if (contentsStatus === $scope.statusCode.publish) {
          //publish
          $scope.label.publish = true;
        } else if (contentsStatus === $scope.statusCode.approval) {
          //approval
          $scope.label.approval = true;
        } else if (contentsStatus === $scope.statusCode.draft) {
          //draft
          $scope.label.draft = true;
        } else if (contentsStatus === $scope.statusCode.disapproval) {
          //disapproval
          $scope.label.disapproval = true;
        }
      };

      /**
       * show result
       *
       * @param {string} type
       * @param {string} message
       * @return {void}
       */
      $scope.showIframeResultMessage = function(type, message) {
        $scope.iframeVisibleMsg = true;
        if (type === 'error') {
          $($scope.iframeResultMessageAttrId)
            .addClass('alert-danger')
            .removeClass('alert-success')
            .fadeIn(500);
        }
        if (type === 'success') {
          $($scope.iframeResultMessageAttrId)
            .removeClass('alert-danger')
            .addClass('alert-success')
            .fadeIn(500).fadeTo(1000, 1).fadeOut(500);
        }
        $($scope.iframeResultMessageAttrId + ' .message').html(message);
      };

      /**
       * post `modified display style`
       *
       * @return {void}
       */
      $scope.postIframeFrameSetting = function() {
        $scope.sendLock = true;
        $http.get($scope.GET_IFRAME_FRAME_SETTING_FORM_URL +
                $scope.frameId + '/' + Math.random())
          .success(function(data, status, headers, config) {
              //POST用のフォームセット
              $($scope.iframePostFormAreaAttrId).html(data);
              var postParams = {};
              //POSTフォームのシリアライズ
              var i = 0;
              var postSerialize = $($scope.iframeFrameSettingPostFormAttrId).
                                           serializeArray();
              var length = postSerialize.length;
              for (i; i < length; i++) {
                postParams[postSerialize[i]['name']] =
                                         postSerialize[i]['value'];
              }
              //入力フォームのシリアライズ
              var inputSerialize = $($scope.iframFrameSettingInputFormAttrId).
                                              serializeArray();
              var length = inputSerialize.length;
              for (i = 0; i < length; i++) {
                postParams[inputSerialize[i]['name']] =
                                         inputSerialize[i]['value'];
              }
              //登録情報をPOST
              $scope.sendIframeFrameSetting(postParams);
              $scope.sendLock = false;
            })
          .error(function(data, status, headers, config) {
              //keyの取得に失敗
              if (! data) { data = 'error'; }
              $scope.showIframeResultMessage('error', data);
              $scope.sendLock = false;
            });
      };

      /**
       * save iframe frame setting
       *
       * @param {Object.<string>} postParams
       * @return {void}
       */
      $scope.sendIframeFrameSetting = function(postParams) {
        $.ajax({
          method: 'POST' ,
          url: $scope.POST_IFRAME_FRAME_SETTING_FORM_URL + $scope.frameId +
              '/' + Math.random(),
          data: postParams,
          success: function(json, status, headers, config) {
            $scope.iframeFrameSettingData = json.data;
            //結果メッセージを表示
            $($scope.iframeFrameSettingResultMessageAttrId)
                    .removeClass('hidden');
            $scope.setIframeFrameSettingLatestData(json);
            $scope.showIframeFrameSettingResultMessage('success', json.message);
            $timeout(function() {
            }, 1000);
          },
          error: function(json, status, headers, config) {
            if (! json.message) {
              $scope.showIframeFrameSettingResultMessage('error', headers);
            } else {
              $scope.showIframeFrameSettingResultMessage('error', json.message);
            }
            $scope.sendLock = false;
          }
        });
      };

      /**
       * set iframe frame setting latest data
       *
       * @param {Object.<string>} json
       * @return {void}
       */
      $scope.setIframeFrameSettingLatestData = function(json) {
        var height = 0;
        var display_scrollbar = false;
        var display_frame = false;
        if (json.data && json.data.IframeFrameSetting.height &&
                json.data.IframeFrameSetting.display_scrollbar &&
                json.data.IframeFrameSetting.display_frame) {
          height = +(json.data.IframeFrameSetting.height);
          display_scrollbar = Boolean(+(json.data
                               .IframeFrameSetting.display_scrollbar));
          display_frame = Boolean(+(json.data
                               .IframeFrameSetting.display_frame));
        }
        //最新データをiframeに反映する
        if ($($scope.iframeElementTag).size() !== 0) {
          $($scope.iframeElementTag).prop('height', height);
          $($scope.iframeElementTag).prop('width', '100%');
          if (display_scrollbar === true) {
            $($scope.iframeElementTag).prop('scrolling', 'yes');
          } else {
            $($scope.iframeElementTag).prop('scrolling', 'no');
          }
          if (display_frame === true) {
            $($scope.iframeElementTag).prop('frameborder', 1);
          } else {
            $($scope.iframeElementTag).prop('frameborder', 0);
          }
        }
        //最新データをフォームに反映する
        $scope.iframeHeight = height;
        $scope.iframeScrollBar = display_scrollbar;
        $scope.iframeFrame = display_frame;
      };

      /**
       * show iframe frame setting result message
       *
       * @param {string} type
       * @param {string} message
       * @return {void}
       */
      $scope.showIframeFrameSettingResultMessage = function(type, message) {
        $scope.iframeFrameSettingVisibleMsg = true;
        if (type === 'error') {
          $($scope.iframeFrameSettingResultMessageAttrId)
            .addClass('alert-danger')
            .removeClass('alert-success')
            .fadeIn(500);
        }
        if (type === 'success') {
          $($scope.iframeFrameSettingResultMessageAttrId)
            .removeClass('alert-danger')
            .addClass('alert-success')
            .fadeIn(500).fadeTo(1000, 1).fadeOut(500);
        }
        $($scope.iframeFrameSettingResultMessageAttrId + ' .message')
                .html(message);
      };

    });
