/**
 * @fileoverview Iframes Javascript
 * @author kotaro.hokada@gmail.com (Kotaro Hokada)
 */


/**
 * Iframes Javascript
 *
 * @param {string} Controller name
 * @param {function(scope, sce, modal, modalStack)} Controller
 */
NetCommonsApp.controller('Iframes',
                         function($scope, $sce, $modal, $modalStack) {

      /**
       * Iframes plugin view url
       *
       * @const
       */
      $scope.PLUGIN_INDEX_URL = '/iframes/iframes/';

      /**
       * Iframes plugin edit url
       *
       * @const
       */
      $scope.PLUGIN_EDIT_URL = '/iframes/iframe_edit/';

      /**
       * Iframes plugin display change url
       *
       * @const
       */
      $scope.PLUGIN_DISPLAY_CHANGE_URL = '/iframes/iframe_display_change/';

      /**
       * iframes plugin id
       *
       * @const
       */
      $scope.IFRAME_ID = '#nc-iframes-';

      /**
       * iframes plugin id
       *
       * @type {sring}
       */
      $scope.iframeId = '';

      /**
       * iframe tag
       *
       * @const
       */
      $scope.IFRAME_TAG = ' iframe';

      /**
       * iframe tag
       *
       * @type {sring}
       */
      $scope.iframeTag = '';

      /**
       * iframe tab parent class
       *
       * @const
       */
      $scope.IFRAME_TAG_PARENT_CLASS = ' .nc-iframes-iframe';

      /**
       * iframe tab parent class
       *
       * @type {sring}
       */
      $scope.iframeTagParentClass = '';

      /**
       * Iframe
       *
       * @type {Object.<string>}
       */
      $scope.iframe = {};

      /**
       * IframeFrameSetting
       *
       * @type {Object.<string>}
       */
      $scope.iframeFrameSetting = {};

      /**
       * Initialize
       *
       * @param {int} frameId
       * @param {Object.<string>} iframe
       * @param {Object.<string>} iframeFrameSetting
       * @return {void}
       */
      $scope.initialize = function(frameId, iframe, iframeFrameSetting) {
        //set frameId
        $scope.frameId = frameId;

        //set the data of iframe
        $scope.iframe = iframe;

        //set the data of iframeFrameSetting
        $scope.iframeFrameSetting = iframeFrameSetting;

        //set iframe id
        $scope.iframeId = $scope.IFRAME_ID + $scope.frameId;

        //set iframe tag
        $scope.iframeTag = $scope.iframeId + $scope.IFRAME_TAG;

        //set parent class of iframe tag
        $scope.iframeTagParentClass =
                            $scope.iframeId + $scope.IFRAME_TAG_PARENT_CLASS;
      };

      /**
       * Change tab
       *
       * @param {number} tab
       * - edit
       * - displayChange
       * @return {void}
       */
      $scope.changeTab = function(tab) {
        //cancel the modal window that is already opened
        $modalStack.dismissAll('canceled');

        var templateUrl = '';
        var controller = '';
        switch (tab) {
          case 'edit':
            templateUrl = $scope.PLUGIN_EDIT_URL + 'view/' + $scope.frameId;
            controller = 'Iframes.edit';
            break;
          case 'displayChange':
            templateUrl =
                $scope.PLUGIN_DISPLAY_CHANGE_URL + 'view/' + $scope.frameId;
            controller = 'Iframes.displayChange';
            break;
          default:
            return;
        }

        //display the dialog.
        $modal.open({
          templateUrl: templateUrl,
          controller: controller,
          backdrop: 'static',
          scope: $scope
        })
        .result.then(
            function(result) {},
            function(reason) {
              if (typeof reason.data === 'object') {
                //openによるエラー
                $scope.flash.danger(reason.status + ' ' + reason.data.name);
              } else if (reason === 'canceled') {
                //cancel
                $scope.flash.close();
              }
            });
      };

      /**
       * Show manage dialog
       *
       * @return {void}
       */
      $scope.showManage = function() {
        $scope.changeTab('edit');
      };
    });


/**
 * Iframes.edit Javascript
 *
 * @param {string} Controller name
 * @param {function(scope, http, modalStack)} Controller
 */
NetCommonsApp.controller('Iframes.edit',
                         function($scope, $http, $modalStack) {

      /**
       * sending
       *
       * @type {string}
       */
      $scope.sending = false;

      /**
       * edit _method
       *
       * @type {Object.<string>}
       */
      $scope.edit = {
        _method: 'POST',
        data: {}
      };

      /**
       * dialog initialize
       *
       * @return {void}
       */
      $scope.initialize = function() {
        $scope.edit.data = {
          Iframe: {
            url: $scope.iframe.Iframe.url,
            status: $scope.iframe.Iframe.status,
            block_id: $scope.iframe.Iframe.block_id,
            id: $scope.iframe.Iframe.id
          },
          Frame: {
            id: $scope.frameId
          },
          _Token: {
            key: '',
            fields: '',
            unlocked: ''
          }
        };
      };
      // initialize()
      $scope.initialize();

      /**
       * dialog cancel
       *
       * @return {void}
       */
      $scope.cancel = function() {
        $modalStack.dismissAll('canceled');
      };

      /**
       * dialog save
       *
       * @param {number} status
       * - 1: Publish
       * - 2: Approve
       * - 3: Draft
       * - 4: Disapprove
       * @return {void}
       */
      $scope.save = function(status) {
        $scope.sending = true;

        $http.get($scope.PLUGIN_EDIT_URL + 'form/' +
                  $scope.frameId + '/' + Math.random() + '.json')
            .success(function(data) {
              //create form element
              var form = $('<div>').html(data);

              //set security key
              $scope.edit.data._Token.key =
                  $(form).find('input[name="data[_Token][key]"]').val();
              $scope.edit.data._Token.fields =
                  $(form).find('input[name="data[_Token][fields]"]').val();
              $scope.edit.data._Token.unlocked =
                  $(form).find('input[name="data[_Token][unlocked]"]').val();

              //set status
              $scope.edit.data.Iframe.status = status;

              //POST the registration data
              $scope.sendPost($scope.edit);
            })
            .error(function(data, status) {
              //failed to get the key
              $scope.flash.danger(status + ' ' + data.name);
              $scope.sending = false;
            });
      };

      /**
       * send post
       *
       * @param {Object.<string>} postParams
       * @return {void}
       */
      $scope.sendPost = function(postParams) {
        $http.post($scope.PLUGIN_EDIT_URL + 'edit/' + Math.random() + '.json',
            $.param(postParams),
            {headers: {'Content-Type': 'application/x-www-form-urlencoded'}})
          .success(function(data) {
              //set latest data
              $scope.setLatestData(data.iframe.Iframe);

              angular.copy(data.iframe, $scope.iframe);
              $scope.flash.success(data.name);
              $scope.sending = false;
              $modalStack.dismissAll('saved');
            })
          .error(function(data, status) {
              $scope.flash.danger(status + ' ' + data.name);
              $scope.sending = false;
            });
      };

      /**
       * set iframe latest data
       *
       * @param {Object.<string>} Iframe
       * @return {void}
       */
      $scope.setLatestData = function(Iframe) {
        if ($($scope.iframeTag).length === 0) {
          //create iframe tag if it isn't created
          $($scope.iframeTagParentClass).html('');
          $($scope.iframeTagParentClass).html($('<iframe width="100%">'));

          //set height
          $($scope.iframeTag).prop('height',
              +($scope.iframeFrameSetting.IframeFrameSetting.height));

          //set scrolling
          $($scope.iframeTag).prop('scrolling',
              (+($scope.iframeFrameSetting
                 .IframeFrameSetting.display_scrollbar) === 1 ? 'yes' : 'no'));

          //set frameborder
          $($scope.iframeTag).prop('frameborder',
              (+($scope.iframeFrameSetting
                 .IframeFrameSetting.display_frame) === 1 ? '1' : '0'));
        }

        //set src
        $($scope.iframeTag).prop('src', Iframe.url);
      };
    });


/**
 * Iframes.displayChange Javascript
 *
 * @param {string} Controller name
 * @param {function(scope, http, modalStack)} Controller
 */
NetCommonsApp.controller('Iframes.displayChange',
                         function($scope, $http, $modalStack) {

      /**
       * sending
       *
       * @type {string}
       */
      $scope.sending = false;

      /**
       * edit _method
       *
       * @type {Object.<string>}
       */
      $scope.edit = {
        _method: 'POST',
        data: {}
      };

      /**
       * dialog initialize
       *
       * @return {void}
       */
      $scope.initialize = function() {
        $scope.edit.data = {
          IframeFrameSetting: {
            height: +($scope.iframeFrameSetting.IframeFrameSetting.height),
            display_scrollbar:
                Boolean(+($scope.iframeFrameSetting
                      .IframeFrameSetting.display_scrollbar)),
            display_frame:
                Boolean(+($scope.iframeFrameSetting
                      .IframeFrameSetting.display_frame)),
            frame_key: $scope.iframeFrameSetting.IframeFrameSetting.frame_key,
            id: $scope.iframeFrameSetting.IframeFrameSetting.id
          },
          _Token: {
            key: '',
            fields: '',
            unlocked: ''
          }
        };
      };
      // initialize()
      $scope.initialize();

      /**
       * dialog cancel
       *
       * @return {void}
       */
      $scope.cancel = function() {
        $modalStack.dismissAll('canceled');
      };

      /**
       * dialog save
       *
       * @return {void}
       */
      $scope.save = function() {
        $scope.sending = true;

        $http.get($scope.PLUGIN_DISPLAY_CHANGE_URL + 'form/' +
                  $scope.frameId + '/' + Math.random() + '.json')
            .success(function(data) {
              //create form element
              var form = $('<div>').html(data);

              //set security key
              $scope.edit.data._Token.key =
                  $(form).find('input[name="data[_Token][key]"]').val();
              $scope.edit.data._Token.fields =
                  $(form).find('input[name="data[_Token][fields]"]').val();
              $scope.edit.data._Token.unlocked =
                  $(form).find('input[name="data[_Token][unlocked]"]').val();

              //POST the registration data
              $scope.sendPost($scope.edit);
            })
            .error(function(data, status) {
              //failed to get the key
              $scope.flash.danger(status + ' ' + data.name);
              $scope.sending = false;
            });
      };

      /**
       * send post
       *
       * @param {Object.<string>} postParams
       * @return {void}
       */
      $scope.sendPost = function(postParams) {
        $http.post($scope.PLUGIN_DISPLAY_CHANGE_URL + 'edit/' +
            Math.random() + '.json',
            $.param(postParams),
            {headers: {'Content-Type': 'application/x-www-form-urlencoded'}})
          .success(function(data) {
              //set latest data if iframe tag is created
              if ($($scope.iframeTag).length === 1) {
                $scope.setLatestData(data.iframeFrameSetting
                                         .IframeFrameSetting);
              }
              angular.copy(data.iframeFrameSetting, $scope.iframeFrameSetting);
              $scope.flash.success(data.name);
              $scope.sending = false;
              $modalStack.dismissAll('saved');
            })
          .error(function(data, status) {
              $scope.flash.danger(status + ' ' + data.name);
              $scope.sending = false;
            });
      };

      /**
       * set iframe frame setting latest data
       *
       * @param {Object.<string>} IframeFrameSetting
       * @return {void}
       */
      $scope.setLatestData = function(IframeFrameSetting) {
        //set height
        $($scope.iframeTag).prop('height', +(IframeFrameSetting.height));

        //set scrolling
        $($scope.iframeTag).prop('scrolling',
            (+(IframeFrameSetting.display_scrollbar) === 1 ? 'yes' : 'no'));

        //set frameborder
        $($scope.iframeTag).prop('frameborder',
            (+(IframeFrameSetting.display_frame) === 1 ? '1' : '0'));
      };
    });
