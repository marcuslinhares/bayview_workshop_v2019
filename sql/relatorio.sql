	use bayview_workshop_db;

	select * from servico;

	create view quantidade_servico as
	select funcionario_id_funcionario, count(funcionario_id_funcionario) as quant_serv
	from servico
	group by funcionario_id_funcionario
	;
	select * from quantidade_servico;

	create view maior_quant_servico as
	select max(quant_serv) as maior
	from quantidade_servico
	;
	select * from maior_quant_servico;

	create view func_max_num_serv as
	select funcionario_id_funcionario, quant_serv
	from quantidade_servico
	where quant_serv = (select maior from maior_quant_servico)
	order by funcionario_id_funcionario asc
	;

	select * from func_max_num_serv;

	select f.nome, fm.quant_serv
	from funcionario as f 
	join  func_max_num_serv as fm
	on f.id_funcionario=fm.funcionario_id_funcionario;

	select * from quantidade_servico
	order by quant_serv desc;

	select f.nome, qs.quant_serv from funcionario as f 
	join quantidade_servico as qs 
	on f.id_funcionario=qs.funcionario_id_funcionario 
	order by qs.quant_serv desc;