const fnMostraMusica = (dataset) => {
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
	const nome = document.createElement('h4');
	nome.textContent = dataset.nome;
	principal.appendChild(nome);
	const duracao = document.createElement('h5');
	duracao.textContent = dataset.duracao;
	principal.appendChild(duracao);
	const genero = document.createElement('h5');
	genero.textContent = dataset.genero;
	principal.appendChild(genero);
	const criador = document.createElement('a');
	criador.href = 'banda.php?banda=' + dataset.criador;
	criador.textContent = dataset.criador;
	principal.appendChild(criador);
	const letra = document.createElement('p');
	letra.textContent = dataset.letra;
	principal.appendChild(letra);
	const video = document.createElement('h6');
	video.textContent = 'Link do video: ' + dataset.video;
	principal.appendChild(video);
	const audio = document.createElement('h6');
	audio.textContent = 'Link do audio: ' + dataset.audio;
	principal.appendChild(audio);
	const estrelas = document.createElement('div');
	estrelas.className = 'estrelas';
	principal.appendChild(estrelas);
	for (let cont = 1; cont <= 5; cont++) {
		let estrela = document.createElement('img');
		estrela.src = './images/EstrelaAzul.png';
		estrela.id = dataset.id + '-' + cont;
		estrela.addEventListener('click', () =>
			fnAvalia(estrela.id, dataset.user)
		);
		estrelas.appendChild(estrela);
	}
	document.body.prepend(musicaGeral);
};
const fnFechar = () => {
	document.getElementById('musica-geral').remove();
};
