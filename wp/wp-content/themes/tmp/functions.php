<?php
locate_template('function/init.php', true);        // 初期設定関数群(主に管理画面)
locate_template('function/custom.php', true);      // 追加関数の書き込み
locate_template('function/cleanup.php', true);     // headerで自動生成される不要なタグを削除する関数群
