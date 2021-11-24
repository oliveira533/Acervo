const fnAvalia = async (id, usuario) => {
	const urlApi = document.URL.replace('avaliacao.php', 'avaliar.php');
	const resposta = await fetch(
		`${urlApi}?usuario=${usuario}&musica=${id.split('-')[0]}&nota=${
			id.split('-')[1]
		}`
	);
	console.log(
		`${urlApi}?usuario=${usuario}&musica=${id.split('-')[0]}&nota=${
			id.split('-')[1]
		}`
	);
	const respostaJson = await resposta.json();
	let imagens = new Array();
	for (let i = 1; i <= 5; i++) {
		imagens.push(document.getElementById(id.split('-')[0] + '-' + i));
	}
	console.log(imagens);
	imagens[0].parentElement.innerHTML = `<p> A nota que você deu foi ${
		respostaJson.notaUser
	} e nota media é ${parseFloat(respostaJson.notaGeral).toFixed(2)} </p>`;
	imagens.forEach((img) => {
		img.remove();
	});
};
