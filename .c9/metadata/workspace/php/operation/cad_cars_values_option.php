{"filter":false,"title":"cad_cars_values_option.php","tooltip":"/php/operation/cad_cars_values_option.php","undoManager":{"mark":100,"position":100,"stack":[[{"start":{"row":15,"column":40},"end":{"row":15,"column":47},"action":"remove","lines":["$result"],"id":454},{"start":{"row":15,"column":40},"end":{"row":15,"column":49},"action":"insert","lines":["$resource"]}],[{"start":{"row":16,"column":17},"end":{"row":16,"column":19},"action":"insert","lines":["[]"],"id":455}],[{"start":{"row":16,"column":18},"end":{"row":16,"column":19},"action":"insert","lines":["0"],"id":456}],[{"start":{"row":16,"column":18},"end":{"row":16,"column":19},"action":"remove","lines":["0"],"id":457}],[{"start":{"row":16,"column":18},"end":{"row":16,"column":19},"action":"insert","lines":["2"],"id":458}],[{"start":{"row":16,"column":28},"end":{"row":17,"column":0},"action":"insert","lines":["",""],"id":459},{"start":{"row":17,"column":0},"end":{"row":17,"column":13},"action":"insert","lines":["             "]}],[{"start":{"row":17,"column":13},"end":{"row":18,"column":0},"action":"insert","lines":["",""],"id":460},{"start":{"row":18,"column":0},"end":{"row":18,"column":13},"action":"insert","lines":["             "]}],[{"start":{"row":18,"column":13},"end":{"row":18,"column":40},"action":"insert","lines":["mysql_free_result($result);"],"id":461}],[{"start":{"row":18,"column":31},"end":{"row":18,"column":38},"action":"remove","lines":["$result"],"id":462}],[{"start":{"row":18,"column":31},"end":{"row":18,"column":32},"action":"insert","lines":["$"],"id":463}],[{"start":{"row":18,"column":32},"end":{"row":18,"column":33},"action":"insert","lines":["r"],"id":464}],[{"start":{"row":18,"column":33},"end":{"row":18,"column":34},"action":"insert","lines":["e"],"id":465}],[{"start":{"row":18,"column":31},"end":{"row":18,"column":34},"action":"remove","lines":["$re"],"id":466},{"start":{"row":18,"column":31},"end":{"row":18,"column":40},"action":"insert","lines":["$resource"]}],[{"start":{"row":15,"column":8},"end":{"row":18,"column":42},"action":"remove","lines":["while ($row = mysql_fetch_array($resource, MYSQL_NUM)) ","             $row[2] .  \";\";","             ","             mysql_free_result($resource);"],"id":467},{"start":{"row":15,"column":8},"end":{"row":18,"column":36},"action":"insert","lines":["while($row = mysql_fetch_row($array))","","            foreach($row as $option)","                echo $option .  \";\";"]}],[{"start":{"row":15,"column":37},"end":{"row":15,"column":43},"action":"remove","lines":["$array"],"id":469},{"start":{"row":15,"column":37},"end":{"row":15,"column":46},"action":"insert","lines":["$resource"]}],[{"start":{"row":14,"column":65},"end":{"row":15,"column":0},"action":"insert","lines":["",""],"id":470},{"start":{"row":15,"column":0},"end":{"row":15,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":33,"column":37},"end":{"row":33,"column":42},"action":"remove","lines":["Value"],"id":471},{"start":{"row":33,"column":37},"end":{"row":33,"column":38},"action":"insert","lines":["N"]}],[{"start":{"row":33,"column":38},"end":{"row":33,"column":39},"action":"insert","lines":["a"],"id":472}],[{"start":{"row":33,"column":39},"end":{"row":33,"column":40},"action":"insert","lines":["m"],"id":473}],[{"start":{"row":33,"column":40},"end":{"row":33,"column":41},"action":"insert","lines":["e"],"id":474}],[{"start":{"row":33,"column":17},"end":{"row":33,"column":22},"action":"remove","lines":["Value"],"id":475},{"start":{"row":33,"column":17},"end":{"row":33,"column":18},"action":"insert","lines":["N"]}],[{"start":{"row":33,"column":18},"end":{"row":33,"column":19},"action":"insert","lines":["a"],"id":476}],[{"start":{"row":33,"column":19},"end":{"row":33,"column":20},"action":"insert","lines":["m"],"id":477}],[{"start":{"row":33,"column":20},"end":{"row":33,"column":21},"action":"insert","lines":["e"],"id":478}],[{"start":{"row":36,"column":15},"end":{"row":36,"column":25},"action":"remove","lines":["$markValue"],"id":479},{"start":{"row":36,"column":15},"end":{"row":36,"column":24},"action":"insert","lines":["$markName"]}],[{"start":{"row":38,"column":66},"end":{"row":38,"column":71},"action":"remove","lines":["Value"],"id":481},{"start":{"row":38,"column":66},"end":{"row":38,"column":67},"action":"insert","lines":["I"]}],[{"start":{"row":38,"column":67},"end":{"row":38,"column":68},"action":"insert","lines":["d"],"id":482}],[{"start":{"row":37,"column":12},"end":{"row":38,"column":0},"action":"insert","lines":["",""],"id":483},{"start":{"row":38,"column":0},"end":{"row":38,"column":12},"action":"insert","lines":["            "]}],[{"start":{"row":36,"column":13},"end":{"row":36,"column":14},"action":"remove","lines":["F"],"id":484}],[{"start":{"row":36,"column":12},"end":{"row":36,"column":13},"action":"remove","lines":["I"],"id":485}],[{"start":{"row":36,"column":12},"end":{"row":36,"column":13},"action":"insert","lines":["i"],"id":486}],[{"start":{"row":36,"column":13},"end":{"row":36,"column":14},"action":"insert","lines":["f"],"id":487}],[{"start":{"row":37,"column":12},"end":{"row":38,"column":0},"action":"insert","lines":["",""],"id":488},{"start":{"row":38,"column":0},"end":{"row":38,"column":12},"action":"insert","lines":["            "]}],[{"start":{"row":38,"column":12},"end":{"row":38,"column":13},"action":"insert","lines":["$"],"id":489}],[{"start":{"row":38,"column":13},"end":{"row":38,"column":14},"action":"insert","lines":["m"],"id":490}],[{"start":{"row":38,"column":14},"end":{"row":38,"column":15},"action":"insert","lines":["a"],"id":491}],[{"start":{"row":38,"column":15},"end":{"row":38,"column":16},"action":"insert","lines":["r"],"id":492}],[{"start":{"row":38,"column":16},"end":{"row":38,"column":17},"action":"insert","lines":["k"],"id":493}],[{"start":{"row":38,"column":17},"end":{"row":38,"column":18},"action":"insert","lines":["i"],"id":494}],[{"start":{"row":38,"column":18},"end":{"row":38,"column":19},"action":"insert","lines":["f"],"id":495}],[{"start":{"row":38,"column":18},"end":{"row":38,"column":19},"action":"remove","lines":["f"],"id":496}],[{"start":{"row":38,"column":18},"end":{"row":38,"column":19},"action":"insert","lines":["f"],"id":497}],[{"start":{"row":38,"column":18},"end":{"row":38,"column":19},"action":"remove","lines":["f"],"id":498}],[{"start":{"row":38,"column":18},"end":{"row":38,"column":19},"action":"insert","lines":["d"],"id":499}],[{"start":{"row":38,"column":18},"end":{"row":38,"column":19},"action":"remove","lines":["d"],"id":500}],[{"start":{"row":38,"column":17},"end":{"row":38,"column":18},"action":"remove","lines":["i"],"id":501}],[{"start":{"row":38,"column":17},"end":{"row":38,"column":18},"action":"insert","lines":["i"],"id":502}],[{"start":{"row":38,"column":18},"end":{"row":38,"column":19},"action":"insert","lines":["d"],"id":503}],[{"start":{"row":38,"column":18},"end":{"row":38,"column":19},"action":"remove","lines":["d"],"id":504}],[{"start":{"row":38,"column":17},"end":{"row":38,"column":18},"action":"remove","lines":["i"],"id":505}],[{"start":{"row":38,"column":17},"end":{"row":38,"column":18},"action":"insert","lines":["O"],"id":506}],[{"start":{"row":38,"column":17},"end":{"row":38,"column":18},"action":"remove","lines":["O"],"id":507}],[{"start":{"row":38,"column":17},"end":{"row":38,"column":18},"action":"insert","lines":["I"],"id":508}],[{"start":{"row":38,"column":18},"end":{"row":38,"column":19},"action":"insert","lines":["d"],"id":509}],[{"start":{"row":38,"column":19},"end":{"row":38,"column":20},"action":"insert","lines":[" "],"id":510}],[{"start":{"row":38,"column":20},"end":{"row":38,"column":21},"action":"insert","lines":["="],"id":511}],[{"start":{"row":38,"column":21},"end":{"row":38,"column":22},"action":"insert","lines":[" "],"id":512}],[{"start":{"row":38,"column":22},"end":{"row":38,"column":23},"action":"insert","lines":["S"],"id":513}],[{"start":{"row":38,"column":23},"end":{"row":38,"column":24},"action":"insert","lines":["q"],"id":514}],[{"start":{"row":38,"column":24},"end":{"row":38,"column":25},"action":"insert","lines":["l"],"id":515}],[{"start":{"row":38,"column":22},"end":{"row":38,"column":25},"action":"remove","lines":["Sql"],"id":516},{"start":{"row":38,"column":22},"end":{"row":38,"column":35},"action":"insert","lines":["SqlController"]}],[{"start":{"row":38,"column":35},"end":{"row":38,"column":36},"action":"insert","lines":[":"],"id":517}],[{"start":{"row":38,"column":36},"end":{"row":38,"column":37},"action":"insert","lines":[":"],"id":518}],[{"start":{"row":38,"column":37},"end":{"row":38,"column":38},"action":"insert","lines":["R"],"id":519}],[{"start":{"row":38,"column":38},"end":{"row":38,"column":39},"action":"insert","lines":["e"],"id":520}],[{"start":{"row":38,"column":37},"end":{"row":38,"column":39},"action":"remove","lines":["Re"],"id":521},{"start":{"row":38,"column":37},"end":{"row":38,"column":44},"action":"insert","lines":["Request"]}],[{"start":{"row":38,"column":44},"end":{"row":38,"column":46},"action":"insert","lines":["()"],"id":522}],[{"start":{"row":38,"column":45},"end":{"row":38,"column":47},"action":"insert","lines":["''"],"id":523}],[{"start":{"row":38,"column":46},"end":{"row":38,"column":47},"action":"insert","lines":["M"],"id":524}],[{"start":{"row":38,"column":47},"end":{"row":38,"column":48},"action":"insert","lines":["a"],"id":525}],[{"start":{"row":38,"column":48},"end":{"row":38,"column":49},"action":"insert","lines":["r"],"id":526}],[{"start":{"row":38,"column":49},"end":{"row":38,"column":50},"action":"insert","lines":["k"],"id":527}],[{"start":{"row":38,"column":50},"end":{"row":38,"column":51},"action":"insert","lines":["d"],"id":528}],[{"start":{"row":38,"column":50},"end":{"row":38,"column":51},"action":"remove","lines":["d"],"id":529}],[{"start":{"row":38,"column":50},"end":{"row":38,"column":51},"action":"insert","lines":["i"],"id":530}],[{"start":{"row":38,"column":51},"end":{"row":38,"column":52},"action":"insert","lines":["f"],"id":531}],[{"start":{"row":38,"column":51},"end":{"row":38,"column":52},"action":"remove","lines":["f"],"id":532}],[{"start":{"row":38,"column":50},"end":{"row":38,"column":51},"action":"remove","lines":["i"],"id":533}],[{"start":{"row":38,"column":49},"end":{"row":38,"column":50},"action":"remove","lines":["k"],"id":534}],[{"start":{"row":38,"column":48},"end":{"row":38,"column":49},"action":"remove","lines":["r"],"id":535}],[{"start":{"row":38,"column":47},"end":{"row":38,"column":48},"action":"remove","lines":["a"],"id":536}],[{"start":{"row":38,"column":46},"end":{"row":38,"column":47},"action":"remove","lines":["M"],"id":537}],[{"start":{"row":38,"column":46},"end":{"row":38,"column":59},"action":"insert","lines":["RequestIdMark"],"id":538}],[{"start":{"row":38,"column":60},"end":{"row":38,"column":61},"action":"insert","lines":[" "],"id":539}],[{"start":{"row":38,"column":61},"end":{"row":38,"column":62},"action":"insert","lines":[","],"id":540}],[{"start":{"row":38,"column":62},"end":{"row":38,"column":63},"action":"insert","lines":[" "],"id":541}],[{"start":{"row":38,"column":60},"end":{"row":38,"column":61},"action":"remove","lines":[" "],"id":542}],[{"start":{"row":38,"column":62},"end":{"row":38,"column":63},"action":"insert","lines":["$"],"id":543}],[{"start":{"row":38,"column":63},"end":{"row":38,"column":64},"action":"insert","lines":["m"],"id":544}],[{"start":{"row":38,"column":64},"end":{"row":38,"column":65},"action":"insert","lines":["a"],"id":545}],[{"start":{"row":38,"column":65},"end":{"row":38,"column":66},"action":"insert","lines":["r"],"id":546}],[{"start":{"row":38,"column":62},"end":{"row":38,"column":66},"action":"remove","lines":["$mar"],"id":547},{"start":{"row":38,"column":62},"end":{"row":38,"column":71},"action":"insert","lines":["$markName"]}],[{"start":{"row":38,"column":72},"end":{"row":38,"column":73},"action":"insert","lines":[";"],"id":548}],[{"start":{"row":39,"column":0},"end":{"row":39,"column":12},"action":"remove","lines":["            "],"id":549}],[{"start":{"row":38,"column":73},"end":{"row":39,"column":0},"action":"remove","lines":["",""],"id":550}],[{"start":{"row":28,"column":23},"end":{"row":28,"column":24},"action":"insert","lines":["1"],"id":551}],[{"start":{"row":27,"column":30},"end":{"row":27,"column":35},"action":"remove","lines":["Value"],"id":552},{"start":{"row":27,"column":30},"end":{"row":27,"column":31},"action":"insert","lines":["N"]}],[{"start":{"row":27,"column":31},"end":{"row":27,"column":32},"action":"insert","lines":["a"],"id":553}],[{"start":{"row":27,"column":32},"end":{"row":27,"column":33},"action":"insert","lines":["m"],"id":554}],[{"start":{"row":27,"column":33},"end":{"row":27,"column":34},"action":"insert","lines":["e"],"id":555}],[{"start":{"row":28,"column":23},"end":{"row":28,"column":24},"action":"remove","lines":["1"],"id":556}],[{"start":{"row":2,"column":0},"end":{"row":2,"column":36},"action":"remove","lines":["require '../SQL/sql_controller.php';"],"id":557},{"start":{"row":2,"column":0},"end":{"row":3,"column":29},"action":"insert","lines":["require '../SQL/sql_controller.php';","require '../objects/car.php';"]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":10,"column":4},"end":{"row":10,"column":4},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1447120145817,"hash":"8a392d608bacaa4c2906146e8c23883752117c37"}