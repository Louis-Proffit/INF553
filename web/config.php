<?php

$host="postgres";
$port="5432";
$databaseName="test";
$user="postgres";
$password="postgres";

$q3_query = "SELECT A.tablename, A.tableowner, A.tablespace FROM pg_tables A WHERE A.schemaname = 'public';";

$q4_query_1 = "SELECT A.oid, C.amname from pg_class A, pg_namespace B , pg_am C where B.oid = A.relnamespace and B.nspname = 'public' and not A.reltype = 0 and A.relam = C.oid and A.relname='";
$q4_query_2 = "';";

$q7_query_1 = 
"WITH myattr
AS (
    SELECT A.relname, B.attname, C.typname 
    FROM pg_class A 
    JOIN pg_attribute B 
    ON A.oid = B.attrelid 
    JOIN pg_type C 
    ON B.atttypid = C.oid 
    JOIN pg_namespace D 
    ON D.oid = A.relnamespace
    WHERE B.attname != 'varchar' 
    AND D.nspname = 'public' 
    AND NOT A.reltype = 0 
    AND A.relkind = 'r'
    and A.relname='";
$q7_query_2 = 
"')
SELECT
    A.attname,
    A.typname,
    CASE
    WHEN B.n_distinct >= 0 THEN B.n_distinct
    WHEN B.n_distinct > -1 THEN -B.n_distinct * C.n_live_tup
    ELSE C.n_live_tup
    END AS distval,
    CASE
    WHEN (B.histogram_bounds::text::varchar[])[1] < (B.most_common_vals::text::varchar[])[1] THEN (B.histogram_bounds::text::varchar[])[1]
    ELSE (B.most_common_vals::text::varchar[])[1]
    END AS min,
    CASE
    WHEN (B.histogram_bounds::text::varchar[])[array_length(B.histogram_bounds, 1)] < (B.most_common_vals::text::varchar[])[array_length(B.most_common_vals, 1)] THEN (B.histogram_bounds::text::varchar[])[array_length(B.histogram_bounds, 1)]
    ELSE (B.most_common_vals::text::varchar[])[array_length(B.most_common_vals, 1)]
    END AS max
FROM myattr AS A
INNER JOIN pg_stats AS B
ON B.tablename = A.relname AND B.attname = A.attname
JOIN pg_stat_user_tables AS C
ON C.relname = A.relname
ORDER BY distval DESC
LIMIT 5;";
?>