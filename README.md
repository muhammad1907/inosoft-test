How to Install it 

Install MongoDB
-Perlu terlebih dahulu terhubung ke instance MongoDB Anda menggunakan shell, seperti mongo. Setelah itu, Anda dapat menggunakan perintah use untuk membuat database baru. Contohnya seperti ini:

mongo
> use inosoft-db

kemudian membuat username dan password untuk database inosoft-db di MongoDB, dengan melakukan langkah-langkah berikut:

-db.createUser({ user: "inosoft_user", pwd: "inosoft_pwd", roles: [ { role: "admin", db: "inosoft-db" } ] })

-Verifikasi bahwa user baru telah berhasil dibuat dengan perintah show users. 
db.getUsers()

-untuk collection anda bisa masuk project directory terlebih dahulu kemudian ketik php artisan migrate

kemudian install composer dengan menggunakan perintah 

composer install

sesudah semua terinstall maka bisa menjalankan aplikasi tersebut dengan menggunakan perintah php artisan serve
