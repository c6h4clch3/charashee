@extends('layouts.app')
@extends('layouts.common_nav_items')

@section('content')
    <div class="row">
        <section>
            <div class="col-xs-12 text-center">
                <h1>Charasheeへようこそ！</h1>
            </div>
        </section>
        <section>
            <div class="col-xs-8 col-xs-offset-2">
                <div class="content">
                    <h2>Charasheeとは？</h2>
                    <p>
                        Charasheeは、クトゥルフ神話TRPGのキャラクターシートを管理するための保管庫ツールです。
                    </p>
                    <p>
                        ステータス算出、スキルセット、ステータス参照技能など、
                        キャラクターシートの作成に便利な機能を取り揃えているほか、
                        GM/KPをする際などに便利な、複数のキャラシをまとめて参照できるグループ機能も完備！
                    </p>
                    <h2>対応ブラウザ</h2>
                    <p>
                        Charasheeは以下のブラウザの
                        <strong>
                            <u>最新版</u>
                        </strong>
                        を対象として開発を行っています。
                    </p>
                    <p>
                        <ul>
                            <li>Edge
                            <li>Google Chrome (PC/Android/iOS)
                            <li>FireFox (PC/Android/iOS)
                            <li>Safari (PC/iOS)
                        </ul>
                    </p>
                    <p>
                        Internet Exprolerは対象外となり、Internet Exproler独自の不具合は修正の予定はありません。ご了承ください。
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
