# 社員管理アプリケーション  
## 概要  
社員情報を管理するための 社員登録サイト です。  
社員の登録・編集・削除などの機能を提供します。  

## 使用技術    
フロントエンド: HTML CSS (Bootstrap)  Javascript  
バックエンド: PHP  
開発環境: MAMP  
エディタ: VSCode  

## 主な画面と機能 

・メイン画面はシンプルなデザインを意識し、上部に検索フォームや登録ボタンを配置、中央〜下部にかけてデータが一覧で見えるように工夫しました。データテーブルのヘッダー行にはフィルター機能も搭載しています。  
・登録・編集画面について、'必須'として入力必須箇所を表示させたり、入力フォームを上〜下に同じ幅で配置することで、入力しやすい設計を意識しました。  
・入力必須箇所について、空白の場合にはエラーメッセージを表示させる、各項目について、文字制限を設定し文字数超過できないように実装、生年月日・入社日について、過去の日付は設定できないようにバリデーションを実装しています。  
・登録日はシステム側で自動設定されるように実装しています。  
・確認画面では入力されている値を変更できないように実装しています。  
・完了画面について、メイン画面に戻れるようにボタンを設置しました。

| メイン画面 | 登録画面 |
| ---- | ---- |
| ![Image](https://github.com/user-attachments/assets/de12de35-ba73-4b90-a959-02f396d3a325) | ![Image](https://github.com/user-attachments/assets/729c9e0a-118b-4842-9d30-3f6cf5ea0338) |

| 登録確認画面 |  登録完了画面 |
| ---- | ---- |
| ![Image](https://github.com/user-attachments/assets/8b346da1-d7f0-41de-bc77-8a0126cd0a41) |　![Image](https://github.com/user-attachments/assets/182f2a43-f6b2-4e2b-8d3c-a8b958696f40) |

| 編集画面 |  編集確認画面 |
| ---- | ---- |
| ![Image](https://github.com/user-attachments/assets/83df88c2-c7bc-4bbf-bdf4-f274e2871e88) |　![Image](https://github.com/user-attachments/assets/ade5b0c6-0c58-45ef-a59d-50bb951de57f) |

| 削除確認画面 |  削除完了画面 |
| ---- | ---- |
| ![Image](https://github.com/user-attachments/assets/44029b40-cd70-492f-9044-2e5b308a3206) |　![Image](https://github.com/user-attachments/assets/441bd1e4-eaa5-4f66-8646-25892af92e26) |

