const fnMostraMusica = (dataset) => {
	console.log(dataset);
	const musicaGeral = document.createElement('div');
	musicaGeral.className = 'musica-geral';
	musicaGeral.id = 'musica-geral';
	const principal = document.createElement('div');
	principal.className = 'informacoes-musica';
	musicaGeral.appendChild(principal);
	const botaoFechar = document.createElement('button');
	botaoFechar.addEventListener('click', fnFechar);
	botaoFechar.className = 'fechar';
	botaoFechar.innerText = 'X';
	principal.appendChild(botaoFechar);
	document.body.prepend(musicaGeral);
};
const fnFechar = () => {
	document.getElementById('musica-geral').remove();
};
