/**
 * @fileoverview iframes Javascript
 * @author kotaro.hokada@gmail.com (Kotaro Hokada)
 */


/**
 * iframe Javascript
 *
 * @param {string} controller name
 * @param {function(scope, http, sce, timeout)} controller scope
 */
NetCommonsApp.controller('Iframes.edit',
                         function($scope, $http, $sce, $timeout) {

      /**
       * plugin url
       *
       * @type {string}
       */
      var pluginsUrl = '/iframes/';

      /**
       * get edit form url
       *
       * @type {string}
       */
      $scope.getEditFormUrl = pluginsUrl + 'iframes/get_edit_form/';

      /**
       * post url
       *
       * @type {string}
       */
      $scope.postUrl = pluginsUrl + 'iframes/edit/';
      //$scope.show = false;

      /**
       * frame id
       *
       * @type {number}
       */
      $scope.frameId = 0;

      /**
       * block id
       *
       * @type {number}
       */
      $scope.blockId = 0;

      /**
       * language id
       *
       * @type {number}
       */
      $scope.langId = 2;

      /**
       * data id
       *
       * @type {number}
       */
      $scope.dataId = 0;

      /**
       * ステータスID
       *  Publish:     1 公開
       *  PublishRequest:  2 公開申請
       *  Draft:       3 下書き
       *  Reject:      4 差し戻し
       *
       * @const
       */
      $scope.statusList = {
        'Publish' : 1,
        'PublishRequest' : 2,
        'Draft' : 3,
        'Reject' : 4
      };

      /**
       * 記事の状態設定
       * ラベルとボタンの表示制御 : お知らせの状態の格納
       *
       * @type {{publish: boolean, draft: boolean, request: boolean, reject: boolean}}
       */
      $scope.label = {
        'publish' : false,
        'draft' : false,
        'request' : false,
        'reject' : false
      };

      /**
       * 表示制御設定
       * @type {{default: boolean, edit: {preview: boolean, body: boolean, detail: boolean}}}
       */
      $scope.View = {
        'default' : true,
        'edit' : {
          'preview' : false,
          'detail' : false,
          'body' : false
        }
      };

      /**
       * プレビューのhtmlデータ
       * TODO：$scope.View.previewとまとめるか検討する。
       *
       * @type {{$scope.dataId = 0;html: null}}
       */
      $scope.Preview = {
        'html' : null
      };

      /**
       * iframe表示エリアのID属性
       *
       * @type {string}
       */
      var viewerAreaTag = '';

      /**
       * iframeタグのID属性
       *
       * @type {string}
       */
      var viewerAreaAttrTag = '';

      /**
       * プレビューエリアのID属性
       *
       * @type {string}
       */
      var previewAreaTag = '';

      /**
       * 編集フォームエリアのID属性
       *
       * @type {string}
       */
      var editFormAreaTag = '';

      /**
       * URLフォームのID属性
       *
       * @type {string}
       */
      var editFormUrlTag = '';

      /**
       * フレームの高さフォームのID属性
       *
       * @type {string}
       */
      var editFormHeightTag = '';

      /**
       * スクロールバーONのID属性
       *
       * @type {string}
       */
      var editFormScrollbarOnTag = '';

      /**
       * スクロールバーOFFのID属性
       *
       * @type {string}
       */
      var editFormScrollbarOffTag = '';

      /**
       * フレーム枠ONのID属性
       *
       * @type {string}
       */
      var editFormScrollFrameOnTag = '';

      /**
       * フレーム枠OFFのID属性
       *
       * @type {string}
       */
      var editFormScrollFrameOffTag = '';

      /**
       * 処理結果メッセージエリアのID属性
       *
       * @type {string}
       */
      var messageTag = '';

      /**
       * 送信のロック設定
       *
       * @type {boolean}
       */
      $scope.sendRock = false;

      /**
       * temporary form
       *
       * @type {array}
      */
      var tmpFormValue = new Array();

      /**
       * 初期値設定 ng-initで指定
       *
       * @param {number} frameId  frames.id
       * @param {number} blockId  blocks.id
       * @param {number} langId  languages.id
       * @return {void}
       */
      $scope.setInit = function(frameId, blockId, langId) {
        $scope.frameId = frameId;
        $scope.blockId = blockId;
        $scope.langId = langId;
      };

      /**
       * idのセット
       *
       * @param {number} frameId  frames.id
       * @return {void}
       */
      $scope.setId = function(frameId) {
        $scope.frameId = frameId;
        //DOM set
        //iframe表示エリアのID属性
        viewerAreaTag = '#nc-iframes-view-' + $scope.frameId;
        //iframeタグのID属性
        viewerAreaAttrTag = '#nc-iframes-view-attr-' + $scope.frameId;
        //URL
        editFormUrlTag = '#nc-iframes-edit-url-' + $scope.frameId;
        //高さ
        editFormHeightTag = '#nc-iframes-edit-height-' + $scope.frameId;
        //スクロールバーON・OFF
        editFormScrollbarOnTag = '#nc-iframes-edit-scrollbar-' +
                                     $scope.frameId + '-1';
        editFormScrollbarOffTag = '#nc-iframes-edit-scrollbar-' +
                                      $scope.frameId + '-0';
        //フレーム枠ON・OFF
        editFormScrollframeOnTag = '#nc-iframes-edit-scrollframe-' +
                                       $scope.frameId + '-1';
        editFormScrollframeOffTag = '#nc-iframes-edit-scrollframe-' +
                                        $scope.frameId + '-0';
        //結果メッセージエリア
        messageTag = '#nc-iframes-mss-' + $scope.frameId;
        //プレビューエリア
        previewAreaTag = '#nc-iframes-preview-' + $scope.frameId;
      };

      /**
       * 編集画面を開く
       *
       * @param {number} frameId  frames.id
       * @return {void}
       */
      $scope.getEditor = function(frameId) {
        //set
        $scope.setId(frameId);
        //フォームデータ退避
        $scope.writeTmp();
        //iframe非表示
        $scope.View.default = false;
        //編集ボタン非表示＆編集エリア表示
        $scope.View.edit.body = true;
      };

      /**
       * 詳細設定フォームを開く
       *
       * @param {number} frameId  frames.id
       * @return {void}
       */
      $scope.detailFormOpen = function(frameId) {
        //詳細設定のリンクを非表示＆フォームを表示
        $scope.View.edit.detail = true;
      };

      /**
       * 編集画面を閉じる
       *
       * @param {int} frameId
       */
      $scope.closeForm = function(frameId) {
        //set
        $scope.setId(frameId);
        //フォームに退避データを格納
        $scope.writeForm();
        //プレビュー非表示
        $scope.closePreview(frameId);
        //編集エリア非表示＆編集ボタン表示
        $scope.View.edit.body = false;
        //詳細設定のフォーム非表示＆リンク表示
        $scope.View.edit.detail = false;
        //iframeの表示
        $scope.View.default = true;
        //メッセージ非表示
        $scope.postAlertClose();
      };

      /**
       * メッセージ（実行結果）を表示
       *
       * @param {string} alertType
       * @param {string} text
       */
      $scope.postAlert = function(alertType , text) {
        $(messageTag).removeClass('hidden');
        if (alertType == 'error') {
          $(messageTag).addClass('alert-danger');
          $(messageTag).removeClass('alert-success');
          $(messageTag + ' .message').html(text);
          $(messageTag).fadeIn(500);
        } else if (alertType == 'success') {
          $(messageTag).addClass('alert-success');
          $(messageTag).removeClass('alert-danger');
          $(messageTag + ' .message').html(text);
          $(messageTag).fadeIn(500).fadeTo(1000, 1).fadeOut(500);
        }
      };

      /**
       * メッセージ（実行結果）を閉じる
       *
       * @return {void}
       */
      $scope.postAlertClose = function() {
        //メッセージエリアを隠す
        $(messageTag).addClass('hidden');
        //メッセージ初期化
        $(messageTag + ' .message').html('');
      };

      /**
       * プレビューの表示
       *
       * @param {int} frameId
       * @return {void}
       */
      $scope.showPreview = function(frameId) {
        //set
        $scope.setId(frameId);
        //プレビューデータ作成
        $scope.createPreviewData(frameId);
        //プレビュー表示＆プレビューボタンOFF＆プレビュー閉じるボタンON＆ラベル表示
        $scope.View.edit.preview = true;
      };

      /**
       * プレビューデータ作成
       *
       * @param {int} frameId
       * @return {void}
       */
      $scope.createPreviewData = function(frameId) {
        //set
        $scope.setId(frameId);
        //URLが入力されていない場合のエラー表示
        var regexp = /^http(s)?:\/\/([\w\-]+)\.([\w\-\.]+)\/([\w\-\.\/#]*)$/;
        if (!$(editFormUrlTag).val().match(regexp)) {
          var notInputUrl = $(' <p> ').text('URLが不正です。');
          //$scope.Preview.html = $sce.trustAsHtml(notInputUrl);
          $(previewAreaTag).html(notInputUrl);
        }
        //フレームの高さが入力されていない場合のエラー表示
        if (!$.isNumeric($(editFormHeightTag).val())) {
          //URLエラーと表示
          if ($(editFormUrlTag).val() == '') {
            var notInputUrlAndHeight = $(' <p> ').text('URLとフレームの高さが不正です。');
            //$scope.Preview.html = $sce.trustAsHtml(notInputUrlAndHeight);
            $(previewAreaTag).html(notInputUrlAndHeight);
          //高さのみの表示
          } else {
            var notInputHeight = $(' <p> ').text('フレームの高さが不正です。');
            //$scope.Preview.html = $sce.trustAsHtml(notInputHeight);
            $(previewAreaTag).html(notInputHeight);
          }
        }
        //URL・高さともに入力されている場合、プレビュー作成
        if ($(editFormUrlTag).val().match(regexp) &&
            $.isNumeric($(editFormHeightTag).val())) {
          //iframeが生成されていない場合、プレビュー用のiframeタグを生成
          if ($(viewerAreaAttrTag).size() == 0) {
            var iframe = $(' <iframe> ')
                         .prop('id', 'nc-iframes-view-attr-' + $scope.frameId);
            $(viewerAreaTag).html(iframe);
          }
          //最新のフォームの内容を格納
          $(viewerAreaAttrTag).prop('src', $(editFormUrlTag).val());
          $(viewerAreaAttrTag).prop('height', $(editFormHeightTag).val());
          $(viewerAreaAttrTag).prop('width', '100%');
          if ($(editFormScrollbarOnTag).prop('checked')) {
            $(viewerAreaAttrTag).prop('scrolling', 'auto');
          } else {
            $(viewerAreaAttrTag).prop('scrolling', 'no');
          }
          if ($(editFormScrollframeOnTag).prop('checked')) {
            $(viewerAreaAttrTag).prop('frameborder', 1);
          } else {
            $(viewerAreaAttrTag).prop('frameborder', 0);
          }
          //プレビューエリアに書き出す
          //$scope.Preview.html = $sce.trustAsHtml($(viewerAreaTag).html());
          $(previewAreaTag).html($(viewerAreaTag).html());
        }
      };

      /**
       * プレビューを閉じる
       *
       * @param {int} frameId
       */
      $scope.closePreview = function(frameId) {
        //set
        $scope.setId(frameId);
        //プレビュー非表示＆プレビューボタンON＆プレビュー閉じるボタンOFF＆ラベル非表示
        $scope.View.edit.preview = false;
        //プレビューをクリア
        //$scope.Preview.html = '';
        $(previewAreaTag).html('');
        //表示用データを編集前に戻す
        if (tmpFormValue['url'] == '') {
          //URLなしの場合はメッセージを格納
          var notRegistUrl = $(' <p> ').text('URLが登録されていません。');
          $(viewerAreaTag).html(notRegistUrl);
        } else {
          //元に戻す
          $(viewerAreaAttrTag).prop('src', tmpFormValue['url']);
          $(viewerAreaAttrTag).prop('height', tmpFormValue['height']);
          if (tmpFormValue['scrollbar'] == 1) {
            $(viewerAreaAttrTag).prop('scrolling', 'auto');
          } else {
            $(viewerAreaAttrTag).prop('scrolling', 'no');
          }
          if (tmpFormValue['scrollframe'] == 1) {
            $(viewerAreaAttrTag).prop('frameborder', 1);
          } else {
            $(viewerAreaAttrTag).prop('frameborder', 0);
          }
        }
      };

      /**
       * フォームデータを配列に退避
       *
       * @return {void}
       */
      $scope.writeTmp = function() {
        tmpFormValue['url'] = $(editFormUrlTag).val();
        tmpFormValue['height'] = $(editFormHeightTag).val();
        if ($(editFormScrollbarOnTag).prop('checked')) {
          tmpFormValue['scrollbar'] = 1;
        } else {
          tmpFormValue['scrollbar'] = 0;
        }
        if ($(editFormScrollframeOnTag).prop('checked')) {
          tmpFormValue['scrollframe'] = 1;
        } else {
          tmpFormValue['scrollframe'] = 0;
        }
      };

      /**
       * 退避データをフォームデータに格納
       *
       * @return {void}
       */
      $scope.writeForm = function() {
        $(editFormUrlTag).val(tmpFormValue['url']);
        $(editFormHeightTag).val(tmpFormValue['height']);
        if (tmpFormValue['scrollbar'] == 1) {
          $(editFormScrollbarOffTag).prop('checked', false);
          $(editFormScrollbarOnTag).prop('checked', true);
        } else {
          $(editFormScrollbarOnTag).prop('checked', false);
          $(editFormScrollbarOffTag).prop('checked', true);
        }
        if (tmpFormValue['scrollframe'] == 1) {
          $(editFormScrollframeOffTag).prop('checked', false);
          $(editFormScrollframeOnTag).prop('checked', true);
        } else {
          $(editFormScrollframeOnTag).prop('checked', false);
          $(editFormScrollframeOffTag).prop('checked', true);
        }
      };

      /**
       * 各ボタン処理
       *   Cancel: 閉じる
       *   Preview: プレビュー
       *   PreviewClose: プレビューの終了
       *   Draft: 下書き
       *   Reject: 差し戻し
       *   PublishRequest: 公開申請
       *   Publish: 公開
       *
       * @param {stirng} type
       * @param {number} frameId
       * @return {void}
       */
      $scope.post = function(type, frameId) {
        //送信中は処理しない
        if ($scope.sendRock) {
          return false;
        }
        //ボタン非活性化
        $('#nc-iframes-' + $scope.frameId + ' button')
          .fadeTo(100, 0.3)
          .attr('disabled', 'disabled');
        //送信をロックする。
        $scope.sendRock = true;
        //set
        $scope.setId(frameId);
        //スクロールバーの状態を設定
        if ($(editFormScrollbarOnTag).prop('checked')) {
          $Scrollbar = 1;
        } else {
          $Scrollbar = 0;
        }
        //フレーム枠の状態を設定
        if ($(editFormScrollframeOnTag).prop('checked')) {
          $Scrollframe = 1;
        } else {
          $Scrollframe = 0;
        }
        //登録処理
        $scope.sendPost(type);
        //送信ロックを解除する
        $scope.sendRock = false;
        //ボタンをdefaultに戻す
        $('#nc-iframes-' + $scope.frameId + ' button')
          .fadeTo(3000, 1)
          .removeAttr('disabled');
        $scope.setViewdDefault();
      };

      /**
       * 登録処理(get)
       *
       * @param {stirng} type
       * @return {void}
       */
      $scope.sendPost = function(type) {
        //Post用のフォームを取得し、POSTする
        $http({
          method: 'GET',
          url: $scope.getEditFormUrl + $scope.frameId + '/' + Math.random()
        })
          .success(function(data, status, headers, config) {
              //set
              $('#nc-iframes-post-' + $scope.frameId).html(data);
              var post_data_form = '#nc-iframes-data-' + $scope.frameId;
              var post_params = {
                'data[_Token][fields]' : $(post_data_form +
                    " input[name='data[_Token][fields]']").val(),
                'data[_Token][key]' : $(post_data_form +
                    " input[name='data[_Token][key]']").val(),
                '_method' : $(post_data_form +
                    " input[name='_method']").val(),
                'data[_Token][unlocked]' : $(post_data_form +
                    " input[name='data[_Token][unlocked]']").val(),
                //'data[IframeDatum][url]' :
                              //encodeURIComponent($(editFormUrlTag).val()),
                'data[IframeDatum][url]' :
                              $(editFormUrlTag).val(),
                'data[IframeDatum][frame_height]' :
                              encodeURIComponent($(editFormHeightTag).val()),
                'data[IframeDatum][scrollbar_show]' :
                              encodeURIComponent($Scrollbar),
                'data[IframeDatum][scrollframe_show]' :
                              encodeURIComponent($Scrollframe),
                'data[IframeDatum][frameId]' :
                              $scope.frameId,
                'data[IframeDatum][blockId]' :
                              $scope.blockId,
                'data[IframeDatum][type]' :
                              type,
                'data[IframeDatum][langId]' :
                              $scope.langId,
                'data[IframeDatum][id]' :
                              $scope.dataId
              };
              //登録情報をPOST
              $scope.sendSavePost(post_params);
            })
          .error(function(data, status, headers, config) {
              //keyの取得に失敗
              if (! data) {
                data = 'ERROR!';
              }
              $scope.postAlert('error', data);
            });
      };

      /**
       * 登録処理(POST)
       *
       * @param {Object.<string>} postParams
       * @return {void}
       */
      $scope.sendSavePost = function(post_params) {
        $.ajax({
          method: 'POST',
          url: $scope.postUrl +
              $scope.frameId +
              '/' +
              Math.random(),
          data: post_params,
          success: function(json, status, headers, config) {
            $scope.setIndex(json);
            $timeout(function() {
              $scope.updateStatus($scope.statusId);
            }, 1000);
            //完了メッセージを表示
            $scope.postAlert('success', json.message);
          },
          error: function() {
            $scope.postAlert('error', 'ERROR!');
          }
        });
      };

      /**
       * 最新の情報にいれかえる
       *
       * @param {Object.<string>} json
       * @return {void}
       */
      $scope.setIndex = function(json) {
        //データを格納
        if (json.data && json.data.IframeDatum.url &&
            json.data.IframeDatum.frame_height &&
            json.data.IframeDatum.scrollbar_show &&
            json.data.IframeDatum.scrollframe_show) {

          var url = decodeURIComponent(json.data.IframeDatum.url);
          var frame_height =
              decodeURIComponent(json.data.IframeDatum.frame_height);
          var scrollbar_show =
              decodeURIComponent(json.data.IframeDatum.scrollbar_show);
          var scrollframe_show =
              decodeURIComponent(json.data.IframeDatum.scrollframe_show);
          var statusId = json.data.IframeDatum.status_id;
        }
        //ラベル - クリア初期値に戻す
        $scope.labelClear();

        //最新データを格納
        if ($(viewerAreaAttrTag).size() == 0) {
          //iframe未作成の場合は作成する
          var iframe = $(' <iframe> ')
                       .prop('id', 'nc-iframes-view-attr-' + $scope.frameId);
          $(viewerAreaTag).html(iframe);
        }
        $(viewerAreaAttrTag).prop('src', url);
        $(viewerAreaAttrTag).prop('height', frame_height);
        $(viewerAreaAttrTag).prop('width', '100%');
        if (scrollbar_show == 1) {
          $(viewerAreaAttrTag).prop('scrolling', 'auto');
        } else {
          $(viewerAreaAttrTag).prop('scrolling', 'no');
        }
        if (scrollframe_show == 1) {
          $(viewerAreaAttrTag).prop('frameborder', 1);
        } else {
          $(viewerAreaAttrTag).prop('frameborder', 0);
        }

        //フォームに最新のデータを格納
        $(editFormUrlTag).prop('src', url);
        $(editFormHeightTag).prop('height', frame_height);
        if (scrollbar_show == 1) {
          $(editFormScrollbarOffTag).prop('checked', 'false');
          $(editFormScrollbarOnTag).prop('checked', 'true');
        } else if (scrollbar_show == 0) {
          $(editFormScrollbarOnTag).prop('checked', 'false');
          $(editFormScrollbarOffTag).prop('checked', 'true');
        }
        if (scrollframe_show == 1) {
          $(editFormScrollframeOffTag).prop('checked', 'false');
          $(editFormScrollframeOnTag).prop('checked', 'true');
        } else if (scrollframe_show == 0) {
          $(editFormScrollframeOnTag).prop('checked', 'false');
          $(editFormScrollframeOffTag).prop('checked', 'true');
        }

        //一時配列に最新のデータを格納
        $scope.writeTmp();
        $scope.blockId = json.data.IframeFrame.block_id;
        $scope.statusId = statusId;
        $scope.closeForm($scope.frameId);
      };

      /**
       * ラベル(状態）をすべてfalseにする。
       */
      $scope.labelClear = function() {
        $scope.label.publish = false;
        $scope.label.draft = false;
        $scope.label.request = false;
        $scope.label.reject = false;
      };

      /**
       * status
       *
       * @param {int} statusId
       */
      $scope.updateStatus = function(statusId) {

        if (statusId == $scope.statusList.Draft) {
          //下書き
          $scope.label.draft = true;
        } else if (statusId == $scope.statusList.Publish) {
          //公開中 //ラベル変更
          $scope.label.publish = true;
        } else if (statusId == $scope.statusList.PublishRequest) {
          //申請中 //ラベルの変更
          $scope.label.request = true;
        }
        else if (statusId == $scope.statusList.Reject) {
          //差し戻し
          $scope.label.reject = true;
        }
      };

      /**
       * Viewの設定を標準値に戻す
       */
      $scope.setViewdDefault = function() {
        $scope.View = {
          'default' : true,
          'edit' : {
            'preview' : false,
            'detail' : false,
            'body' : false
          }
        };
      };

      /**
       * ブロック設定のモーダルを表示させる。
       *
       * @param {int} frameId
       */
      $scope.openBlockSetting = function(frameId) {
        $scope.setId(frameId);
      };

    });

NetCommonsApp.controller('Iframes.setting', function($scope, $http) {

});
