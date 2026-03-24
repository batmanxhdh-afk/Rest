<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Login — RUST VIP</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Orbitron',sans-serif;color:#ff1a1a}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
overflow:hidden;
background:#000;
position:relative
}

body::before{
content:"";
position:absolute;
inset:0;
background:url("https://media.livewallpapers.com/images/high/geometric-black-abstract-design.webp") center/cover no-repeat;
opacity:.35;
z-index:0
}

body::after{
content:"";
position:absolute;
inset:0;
background:radial-gradient(circle at top,rgba(40,0,0,.65),#000 80%);
z-index:1
}

.main-bg{
position:absolute;
inset:0;
background:linear-gradient(120deg,rgba(255,0,0,.08),rgba(0,0,0,.9));
z-index:1
}

.login-container{
z-index:2;
width:100%;
max-width:360px;
padding:24px
}

.login-box{
background:rgba(10,0,0,.82);
border:1px solid #ff0000;
border-radius:18px;
padding:30px 26px;
box-shadow:0 0 35px rgba(255,0,0,.9),0 0 70px rgba(0,0,0,.9) inset;
backdrop-filter:blur(12px);
text-align:center
}

.login-box::before{
content:"PREDICTION SYSTEM";
display:block;
margin-bottom:12px;
color:#ff1a1a;
letter-spacing:.25em;
font-size:11px;
text-shadow:0 0 12px #ff0000
}

.logo{
font-size:20px;
letter-spacing:.25em;
text-transform:uppercase;
text-shadow:0 0 18px #ff0000,0 0 40px #000;
margin-bottom:24px
}

.input-group{margin-bottom:16px}

.input-group input{
width:100%;
padding:14px;
text-align:center;
background:#070000;
border:1px solid #ff0000;
border-radius:12px;
outline:none;
font-size:13px;
letter-spacing:.15em;
transition:.25s
}

.input-group input::placeholder{
color:#ff4d4d
}

.input-group input:focus{
box-shadow:0 0 18px rgba(255,0,0,.9);
background:#0c0000
}

.login-btn{
width:100%;
padding:15px;
margin-top:6px;
background:linear-gradient(135deg,#200000,#000);
border:1px solid #ff0000;
border-radius:14px;
cursor:pointer;
letter-spacing:.2em;
text-transform:uppercase;
box-shadow:0 0 20px rgba(255,0,0,.8);
transition:.25s
}

.login-btn:hover{
filter:brightness(1.35);
box-shadow:0 0 30px #ff0000
}

.social-links{
margin-top:18px;
display:flex;
justify-content:center;
gap:16px
}

.social-btn{
width:46px;
height:46px;
border-radius:50%;
border:1px solid #ff0000;
display:flex;
align-items:center;
justify-content:center;
box-shadow:0 0 14px rgba(255,0,0,.7);
transition:.25s
}

.social-btn:hover{
transform:scale(1.1);
box-shadow:0 0 28px #ff0000
}

.social-btn img{
width:24px;
filter:drop-shadow(0 0 6px #ff0000)
}

#cyber-toast{
position:fixed;
left:50%;
bottom:-120px;
transform:translateX(-50%);
min-width:280px;
max-width:90%;
padding:14px 18px;
background:rgba(10,0,0,.95);
border:1px solid #ff0000;
box-shadow:0 0 25px rgba(255,0,0,.9);
border-radius:14px;
backdrop-filter:blur(8px);
text-align:center;
letter-spacing:.14em;
z-index:999;
opacity:0;
transition:.4s ease
}

#cyber-toast.show{
bottom:30px;
opacity:1
}

#cyber-toast::before{
content:"[ SYSTEM ]";
display:block;
color:#ff0000;
font-size:11px;
margin-bottom:6px;
text-shadow:0 0 10px #ff0000
}

#cyber-toast.error{
border-color:#ff0000;
box-shadow:0 0 25px rgba(255,0,0,.7)
}

#cyber-toast.success{
border-color:#ff0000;
box-shadow:0 0 25px rgba(255,0,0,.9)
}

.glitch{animation:glitch .15s infinite alternate}

@keyframes glitch{
0%{transform:translateX(-50%) translate(0)}
25%{transform:translateX(-50%) translate(-1px,1px)}
50%{transform:translateX(-50%) translate(1px,-1px)}
75%{transform:translateX(-50%) translate(-1px,-1px)}
100%{transform:translateX(-50%) translate(1px,1px)}
}
</style>
</head>
<body>

<div class="main-bg"></div>

<div class="login-container">
<div class="login-box">
<div class="logo">RUSRT SCRIPT</div>

<div class="input-group">
<input type="text" id="user_id" placeholder="ID">
</div>

<div class="input-group">
<input type="text" id="otp_code" placeholder="Activation Code">
</div>

<button class="login-btn" onclick="login()">Activate</button>

<div class="social-links">
<a class="social-btn" href="https://t.me/ss_vpn" target="_blank">
<img src="https://img.icons8.com/?size=100&id=hMdroXN9qFHy&format=png">
</a>
<a class="social-btn" href="https://t.me/F_zcx" target="_blank">
<img src="https://img.icons8.com/?size=100&id=m3HsiO7YrxuF&format=png">
</a>
</div>

</div>
</div>

<div id="cyber-toast"></div>

<script>
function notify(t,x='info',g=false){
const e=document.getElementById('cyber-toast')
e.className=''
e.textContent=t
e.classList.add('show')
if(x)e.classList.add(x)
if(g)e.classList.add('glitch')
setTimeout(()=>e.classList.remove('show','error','success','glitch'),2200)
}

async function login(){
const u=user_id.value.trim()
const k=otp_code.value.trim()
if(!u||!k){notify('ACCESS DENIED','error',true);return}

try{
const r=await fetch('otp.php',{
method:'POST',
headers:{'Content-Type':'application/json'},
body:JSON.stringify({user_id:u,otp_code:k})
})

const txt=await r.text()
let j=null
try{j=JSON.parse(txt)}catch{}

if(j&&j.success!==undefined){
if(j.success!==true){notify('ACCESS DENIED','error',true);return}
if(j.html){
notify('ACCESS GRANTED','success',true)
setTimeout(()=>{
document.open()
document.write(j.html)
document.close()
},900)
return
}
}

notify('ACCESS GRANTED','success',true)
setTimeout(()=>{
document.open()
document.write(txt)
document.close()
},900)

}catch{
notify('NETWORK ERROR','error',true)
}
}
</script>

</body>
</html>