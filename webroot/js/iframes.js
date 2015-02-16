/**
 * @fileoverview Iframes Javascript
 * @author kotaro.hokada@gmail.com (Kotaro Hokada)
 */


/**
 * IframeEdit Javascript
 *
 * @param {string} Controller name
 * @param {function($scope, NetCommonsBase, NetCommonsTab,
 *                   NetCommonsUser, NetCommonsWorkflow)} Controller
 */
NetCommonsApp.controller('IframeEdit',
    function($scope, NetCommonsBase, NetCommonsTab,
    NetCommonsUser, NetCommonsWorkflow) {

      /**
       * tab
       *
       * @type {object}
       */
      $scope.tab = NetCommonsTab.new();

      /**
       * show user information method
       *
       * @param {number} users.id
       * @return {string}
       */
      $scope.user = NetCommonsUser.new();

      /**
       * workflow
       *
       * @type {object}
       */
      $scope.workflow = NetCommonsWorkflow.new($scope);

      /**
       * serverValidationClear method
       *
       * @param {number} users.id
       * @return {string}
       */
      $scope.serverValidationClear = NetCommonsBase.serverValidationClear;

      /**
       * Initialize
       *
       * @return {void}
       */
      $scope.initialize = function(iframes) {
        $scope.iframes = iframes;
      };
    });


/**
 * IframeFrameSetting Javascript
 *
 * @param {string} Controller name
 * @param {function($scope, $scope, NetCommonsBase, NetCommonsTab)} Controller
 */
NetCommonsApp.controller('IframeFrameSetting',
    function($scope, NetCommonsBase, NetCommonsTab) {

      /**
       * tab
       *
       * @type {object}
       */
      $scope.tab = NetCommonsTab.new();

      /**
       * serverValidationClear method
       *
       * @param {number} users.id
       * @return {string}
       */
      $scope.serverValidationClear = NetCommonsBase.serverValidationClear;

      /**
       * Initialize
       *
       * @return {void}
       */
      $scope.initialize = function(iframeFrameSettings) {
        //文字列となるため、キャストしてng-modelへ格納
        iframeFrameSettings['height'] = parseInt(iframeFrameSettings['height']);
        $scope.iframeFrameSettings = iframeFrameSettings;
      };
    });
