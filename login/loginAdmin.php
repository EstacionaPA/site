<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Estaciona PA</title>
	<link rel="stylesheet" type="text/css" href="../css/login_admin.css">
	<link rel="stylesheet" type="text/css" href="../css/empresa.css">
    
</head>
<body>

<div class="backGround">
    <ul class="menuDropDown">
        <li><a href="../index.html">Inicio</a></li>
        <li><a href="../index.html">Cadastrar Funcionarios</a></li>
        <li><a href="about.html">Gerar Relatório</a></li>
        <li><a href="about.html">Realizar Check-in</a></li>
        <li><a href="#"> <?php include_once ('../php/name_user.php');?></a>
        </li>	 
    </ul>
</div>

<h1>Sobre a empresa</h1>

<div class="layout">

	<p>

		A empresa EstacionaPA vem com uma grande novidade: o nosso site! Onde, por indas e vindas, traz o benefício de poder reservar uma vaga no nosso estacionamento em sua própria casa. Isso mesmo! Você, no conforto da sua casa, vai poder reservar uma vaga no horário em que quiser!	
	</p>
	<p>
		A nossa empresa conta com muitas vagas disponíveis e com segurança total ao seu veículo.
	</p>
	<p>
		Confira nossa tabela de preço:
	</p>

	<table>
		<thead>
			<tr>
				<th>Veículo</th>
				<th>Primeira Hora</th>
				<th>Demais horas</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Carro Grande</td>
				<td>R$ 4,00</td>
				<td>R$ 3,50</td>				
			</tr>

			<tr>
				<td>Carro Pequeno</td>
				<td>R$ 3,00</td>
				<td>R$ 2,50</td>
			</tr>

		</tbody>
	</table>

	<p>
		Observação: Não trabalhamos com horas fracionadas!
	</p>

</div>

</body>
</html>