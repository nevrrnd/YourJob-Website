{{-- Soft animated indigo->violet WebGL background (TalentFlow style).
     Dipakai sebagai latar hero. Menghasilkan wash pastel lembut sehingga
     teks gelap di atasnya tetap terbaca. Otomatis diam saat user meminta
     reduced motion, dan punya fallback gradient kalau WebGL tidak tersedia. --}}
<div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden bg-gradient-to-b from-blue-50/60 via-white to-slate-50">
    <canvas id="hero-shader" class="block h-full w-full"></canvas>
</div>
<script>
(function () {
    var canvas = document.getElementById('hero-shader');
    if (!canvas) return;

    function syncSize() {
        var w = canvas.clientWidth || 1280;
        var h = canvas.clientHeight || 720;
        if (canvas.width !== w || canvas.height !== h) {
            canvas.width = w;
            canvas.height = h;
        }
    }
    if (typeof ResizeObserver !== 'undefined') {
        new ResizeObserver(syncSize).observe(canvas);
    }
    syncSize();

    var gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
    if (!gl) return; // fallback: gradient dari wrapper tetap tampil

    var vs = 'attribute vec2 a_position;varying vec2 v_texCoord;void main(){v_texCoord=a_position*0.5+0.5;gl_Position=vec4(a_position,0.0,1.0);}';
    var fs = 'precision highp float;varying vec2 v_texCoord;uniform float u_time;void main(){' +
        'vec2 uv=v_texCoord;' +
        'float noise=sin(uv.x*3.0+u_time*0.5)*cos(uv.y*2.0-u_time*0.3);' +
        'float noise2=cos(uv.x*2.0-u_time*0.4)*sin(uv.y*3.0+u_time*0.6);' +
        'vec3 color1=vec3(0.275,0.282,0.831);' +   // #4648d4 indigo
        'vec3 color2=vec3(0.545,0.361,0.965);' +   // #8b5cf6 violet
        'vec3 color3=vec3(0.98,0.97,1.0);' +       // soft near-white
        'vec3 c=mix(color1,color2,uv.x+noise*0.2);' +
        'c=mix(c,color3,0.85+noise2*0.1);' +
        'gl_FragColor=vec4(c,1.0);}';

    function cs(type, src) {
        var s = gl.createShader(type);
        gl.shaderSource(s, src);
        gl.compileShader(s);
        return s;
    }
    var prog = gl.createProgram();
    gl.attachShader(prog, cs(gl.VERTEX_SHADER, vs));
    gl.attachShader(prog, cs(gl.FRAGMENT_SHADER, fs));
    gl.linkProgram(prog);
    gl.useProgram(prog);

    var buf = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, buf);
    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1, -1, 1, -1, -1, 1, 1, 1]), gl.STATIC_DRAW);
    var pos = gl.getAttribLocation(prog, 'a_position');
    gl.enableVertexAttribArray(pos);
    gl.vertexAttribPointer(pos, 2, gl.FLOAT, false, 0, 0);
    var uTime = gl.getUniformLocation(prog, 'u_time');

    function draw(t) {
        gl.viewport(0, 0, canvas.width, canvas.height);
        if (uTime) gl.uniform1f(uTime, t * 0.001);
        gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);
    }

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduceMotion) {
        draw(2000); // satu frame statis
        return;
    }

    function render(t) {
        if (typeof ResizeObserver === 'undefined') syncSize();
        draw(t);
        requestAnimationFrame(render);
    }
    requestAnimationFrame(render);
})();
</script>
