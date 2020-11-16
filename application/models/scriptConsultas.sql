-- vista abonado
create view as v_abonado
select id_ numerocuenta, per.nombres as nombres, per.apellidos, per.ci, per.direccion, per.telefono, per.celular,
		cat.detallecategoria, lec.fechalectura, lec.lectura
from abonado abo, persona per, categoria cat, medidor med, lectura lec
where abo.id_persona = per.id_persona
    and abo.id_categoria = cat.id_categoria
    and abo.id_medidor = med.id_medidor
    and med.id_medidor = lec.id_medidor;
--> otro

create view v_abonado as
select distinct (numerocuenta) as numerocuenta, id_abonado,
		(zon.numero*100000000+man.numeromanzano*10000+zonif.vivienda)::text as codigousuario,  
		per.nombres as nombres, per.apellidos, per.ci, per.direccion, per.telefono, per.celular,
		cat.detallecategoria, lec.fechalectura, lec.lectura
from abonado as abo 
	join persona as per on per.id_persona = abo.id_persona
	join categoria cat on cat.id_categoria = abo.id_categoria
	join medidor med on med.id_medidor = abo.id_medidor
	join lectura lec on lec.id_medidor = med.id_medidor
	join zonificacion zonif on zonif.id_medidor = med.id_medidor
	join zona zon on zon.id_zona = zonif.id_zona
	join manzano man on man.id_manzano = zonif.id_manzano

-- vista reclamo
create view v_reclamo as
select id_reclamo, numero, fechareclamo, fecharespuesta, rec.id_persona, rec.id_abonado, rec.id_clasereclamo, rec.id_formareclamo,
	abo.numerocuenta, nombreclase, nombreforma
from reclamo as rec
	join persona per on per.id_persona = rec.id_reclamo
	join abonado abo on abo.id_abonado = rec.id_abonado
	join clasereclamo cr on cr.id_clasereclamo = rec.id_clasereclamo
	join formareclamo fr on fr.id_formareclamo = rec.id_formareclamo

--vista reclamo
create view v_reclamo_only as
select r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, r.motivo, f.nombreforma, zo.numero as zona, ma.numeromanzano, z.vivienda
		from funcionario fu
		join reclamo r on r.id_funcionario = fu.id_funcionario
		join persona p on p.id_persona = r.id_persona
		join formareclamo f on f.id_formareclamo = r.id_formareclamo
		join clasereclamo c on c.id_clasereclamo = r.id_clasereclamo
		join abonado a on a.id_abonado = r.id_abonado
		join medidor m on m.id_medidor = a.id_medidor
		join zonificacion z on z.id_medidor = m.id_medidor
		join zona zo on zo.id_zona = z.id_zona
		join manzano ma on ma.id_manzano = z.id_manzano
		--where r.estadoreclamo = '0' and fu.id_funcionario = $idpersona
		order by r.numero desc


select *
from archivo
join formularioinspecciontres_archivo
on archivo.id_archivo = formularioinspecciontres_archivo.id_archivo
where formularioinspecciontres_archivo.id_formularioinspecciontres = 18


------------------------------------------------
create view v_listareclamo as
select id_reclamo, numero, fechareclamo, fecharespuesta, motivo, (per.nombres || per.apellidos)as reclamante, 
	nombreclase, nombreforma, nombretiporeclamo, (abonado.nombres || abonado.apellidos) as abonado
from reclamo rec
join persona per on per.id_persona = rec.id_persona
join abonado abo on abo.id_abonado = rec.id_abonado
join clasereclamo cr on cr.id_clasereclamo = rec.id_clasereclamo
join formareclamo fr on fr.id_formareclamo = rec.id_formareclamo 
join tiporeclamo tr on tr.id_tiporeclamo = rec.id_tiporeclamo
join persona abonado on abonado.id_persona = abo.id_abonado

where rec.id_persona = 26
and rec.id_abonado = 37641
and rec.id_clasereclamo = 2
and rec.id_formareclamo = 2
and rec.id_formareclamo = 2


-- vista m
create view col_reclamo as
SELECT p.nombres, p.apellidos, r.estadoreclamo, p.direccion, p.telefono, p.ci, 
    p.nit, r.motivo, r.numero, r.fechareclamo, r.fecharespuesta, r.id_persona, 
    r.id_abonado, c.detallecategoria, t.nombretiporeclamo, r.id_funcionario, 
    cl.nombreclase, 
    (zon.numero * 100000000 + man.numeromanzano * 10000 + z.vivienda)::integer AS codigousuario
   FROM reclamo r
   JOIN persona p ON p.id_persona = r.id_persona
   JOIN abonado a ON a.id_abonado = r.id_abonado
   JOIN tiporeclamo t ON t.id_tiporeclamo = r.id_tiporeclamo
   JOIN clasereclamo cl ON cl.id_clasereclamo = r.id_clasereclamo
   JOIN categoria c ON c.id_categoria = a.id_categoria
   JOIN medidor m ON m.id_medidor = a.id_medidor
   JOIN zonificacion z ON z.id_medidor = m.id_medidor
   JOIN zona zon ON zon.id_zona = z.id_zona
   JOIN manzano man ON man.id_manzano = z.id_manzano
  ORDER BY r.id_reclamo;	

-- resetear id de una tabla
  ALTER SEQUENCE seguimiento_id_seguimiento_seq RESTART WITH 1;
UPDATE seguimiento SET id_seguimiento=nextval('seguimiento_id_seguimiento_seq');





select r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, 
(date(r.fecharespuesta)) as fin, r.motivo, f.nombreforma, 
(zo.numero*100000000 + ma.numeromanzano*10000 + z.vivienda) as codigousuario
		from seguimiento s 
		join funcionario fu on fu.id_funcionario = s.id_funcionario 
		join reclamo r on r.id_reclamo = s.id_reclamo 
		join persona p on p.id_persona = r.id_persona 
		join formareclamo f on f.id_formareclamo = r.id_formareclamo 
		join clasereclamo c on c.id_clasereclamo = r.id_clasereclamo 
		join abonado a on a.id_abonado = r.id_abonado 
		join medidor m on m.id_medidor = a.id_medidor 
		join zonificacion z on z.id_medidor = m.id_medidor 
		join zona zo on zo.id_zona = z.id_zona 
		join manzano ma on ma.id_manzano = z.id_manzano
		where r.estadoreclamo = '4'
		and s.id_funcionario = 190
		and s.estadoseguimiento = '4' 
		order by r.numero desc 