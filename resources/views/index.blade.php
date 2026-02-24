<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KE-Kantin</title>

<style>

/* ================= RESET ================= */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body{
  min-height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
  background: linear-gradient(135deg, #2f5f9f, #3f6fb3);
  overflow:hidden;
}

/* ================= CONTAINER ================= */
.container{
  background:white;
  width:90%;
  max-width:420px;
  padding:50px 35px;
  border-radius:20px;
  text-align:center;
  box-shadow:0 15px 40px rgba(0,0,0,0.2);
  animation:fadeIn 0.6s ease-in-out;
}

/* ================= LOGO ================= */
.logo{
  font-size:34px;
  font-weight:800;
  color:#2f5f9f;
  margin-bottom:10px;
}

.tagline{
  font-size:14px;
  color:#777;
  margin-bottom:40px;
}

/* ================= BUTTON ================= */
.btn{
  display:block;
  width:100%;
  padding:14px;
  margin-bottom:15px;
  border-radius:12px;
  border:none;
  font-size:15px;
  font-weight:600;
  cursor:pointer;
  transition:0.3s;
}

.btn-siswa{
  background:#2f5f9f;
  color:white;
}

.btn-siswa:hover{
  background:#3f6fb3;
  transform:translateY(-2px);
  box-shadow:0 6px 15px rgba(47,95,159,0.4);
}

.btn-kantin{
  background:white;
  color:#2f5f9f;
  border:2px solid #2f5f9f;
}

.btn-kantin:hover{
  background:#2f5f9f;
  color:white;
  transform:translateY(-2px);
  box-shadow:0 6px 15px rgba(47,95,159,0.4);
}

/* ================= FOOTER ================= */
.footer{
  margin-top:25px;
  font-size:12px;
  color:#aaa;
}

/* ================= ANIMATION ================= */
@keyframes fadeIn{
  from{
    opacity:0;
    transform:translateY(20px);
  }
  to{
    opacity:1;
    transform:translateY(0);
  }
}

/* ================= RESPONSIVE ================= */
@media(max-width:480px){
  .container{
    padding:40px 25px;
  }

  .logo{
    font-size:28px;
  }
}

</style>
</head>

<body>

<div class="container">

  <div class="logo">KE-Kantin</div>
  <div class="tagline">Sistem Digital Kantin Sekolah</div>

  <button class="btn btn-siswa" onclick="location.href='{{ route('login') }}'">
    Login sebagai Siswa
  </button>

  <button class="btn btn-kantin" onclick="location.href='{{ route('login.bule') }}'">
    Login sebagai Kantin
  </button>

  <div class="footer">
    © 2026 KE-Kantin
  </div>

</div>

</body>
</html>
