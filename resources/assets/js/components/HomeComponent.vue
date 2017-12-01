<template functional>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">ホーム</div>

        <div class="panel-body">
          <h3>Welcome to Charashee!</h3>
          <section>
            <h4>
              <router-link to="/character?page=1">
                キャラクター一覧
              </router-link>
            </h4>
            <p>
              - 登録されているキャラクターシート全てのリスト
            </p>
          </section>
          <section>
            <h4>
              <router-link to="/character/user">
                所有キャラクター一覧
              </router-link>
            </h4>
            <p>
              - 自身が所有しているキャラクターシート全てのリスト
            </p>
          </section>
          <section>
            <h4>
              <router-link to="/character/create">
                新規作成
              </router-link>
            </h4>
            <p>
              - キャラクターを新規作成する
            </p>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>
