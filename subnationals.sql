SELECT h.tid, h.parent, fd.tid, fd.vid, fd.name, fc.field_country_target_id from taxonomy_term_field_data fd
INNER JOIN
taxonomy_term_hierarchy h ON (h.tid = fd.tid)
INNER JOIN
taxonomy_term__field_country fc ON (fc.entity_id = fd.tid)
WHERE vid = 'subnational_level' AND fc.field_country_target_id = 8;
