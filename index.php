<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Loading — RUST VIP</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Roboto',sans-serif!important;
font-weight:900!important;
color:#ff1a1a
}
body{
height:100vh;
display:flex;
flex-direction:column;
justify-content:center;
align-items:center;
overflow:hidden;
background:radial-gradient(circle at top,#0b0000,#000000 80%);
position:relative
}
canvas{
position:absolute;
inset:0;
z-index:0;
pointer-events:none
}
.logo{
font-size:30px;
letter-spacing:.18em;
text-transform:uppercase;
text-shadow:0 0 10px #ff0000,0 0 25px #ff0000,0 0 40px #000;
margin-bottom:30px;
opacity:0;
animation:smoothFade 4s infinite ease-in-out;
z-index:2
}
@keyframes smoothFade{
0%{opacity:.2;transform:scale(.98)}
25%{opacity:1;transform:scale(1.02);text-shadow:0 0 25px #ff0000,0 0 50px #000}
50%{opacity:.8;transform:scale(1)}
75%{opacity:1;transform:scale(1.02);text-shadow:0 0 35px #ff0000,0 0 60px #000}
100%{opacity:.2;transform:scale(.98)}
}
.progress-container{
position:fixed;
bottom:40px;
left:50%;
transform:translateX(-50%);
width:400px;
max-width:80vw;
text-align:center;
z-index:2
}
.progress-bar{
width:100%;
height:6px;
background:rgba(255,0,0,.15);
border-radius:12px;
overflow:hidden;
margin-bottom:10px;
box-shadow:0 0 15px rgba(255,0,0,.6),0 0 25px #000 inset
}
.progress-fill{
width:0%;
height:100%;
background:linear-gradient(90deg,#ff0000,#8b0000,#ff0000);
background-size:200% 100%;
box-shadow:0 0 20px #ff0000,0 0 40px #000;
border-radius:12px;
transition:width .1s cubic-bezier(.25,.1,.25,1)
}
.progress-percent{
font-size:15px;
letter-spacing:.12em;
color:#ff1a1a;
text-shadow:0 0 12px #ff0000,0 0 30px #000;
opacity:.9
}
</style>
</head>
<body>

<canvas id="particles"></canvas>

<div class="logo">RUST OFFICIAL</div>

<div class="progress-container">
<div class="progress-bar">
<div class="progress-fill" id="progressFill"></div>
</div>
<div class="progress-percent" id="progressPercent">0%</div>
</div>

<script>
(function(){
let startTime=performance.now();
const duration=4000;
const fill=document.getElementById('progressFill');
const percent=document.getElementById('progressPercent');

function updateProgress(){
const current=performance.now();
const elapsed=current-startTime;
const progress=Math.min((elapsed/duration)*100,100);

fill.style.width=progress+'%';
percent.textContent=Math.floor(progress)+'%';

if(progress<100){
requestAnimationFrame(updateProgress);
}else{
setTimeout(()=>{
window.location.href='Login.php'
},300)
}
}
requestAnimationFrame(updateProgress);

const canvas=document.getElementById('particles');
const ctx=canvas.getContext('2d');
let w,h,p=[];

function resize(){
w=canvas.width=window.innerWidth;
h=canvas.height=window.innerHeight;
p=[];
for(let i=0;i<120;i++){
p.push({
x:Math.random()*w,
y:Math.random()*h,
vx:(Math.random()-.5)*.4,
vy:(Math.random()-.5)*.4,
s:Math.random()*2+.6
})
}
}
resize();
window.addEventListener('resize',resize);

function draw(){
ctx.clearRect(0,0,w,h);
ctx.fillStyle='rgba(0,0,0,.25)';
ctx.fillRect(0,0,w,h);

for(let i=0;i<p.length;i++){
let a=p[i];
a.x+=a.vx;
a.y+=a.vy;

if(a.x<0||a.x>w)a.vx*=-1;
if(a.y<0||a.y>h)a.vy*=-1;

ctx.beginPath();
ctx.arc(a.x,a.y,a.s,0,Math.PI*2);
ctx.fillStyle='rgba(255,0,0,.8)';
ctx.shadowBlur=18;
ctx.shadowColor='#ff0000';
ctx.fill()
}
requestAnimationFrame(draw)
}
draw()
})();
</script>

</body>
</html>