CREATE  OR REPLACE VIEW `vw_notifications` AS
select n.*,
case from_table 
	when 'team' then team.name
	when 'member' then member.first_name 
	else 'Admin'
end as 'From'
 from notifications n
left join 
member on member.id = from_key and from_table = 'member'
left join
team on team.id = from_key and from_table = 'team'
;
