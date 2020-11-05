<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<body>
<h1>Добавление слова</h1>
<label>
	Слово:
	<input name="word" id="word" value="" onchange="checkWord(this)" oninput="checkWord(this)">
</label>
</br>
<label>Описание:</label>
</br>
<textarea name="description" id="description" rows="10" cols="100"></textarea>
</br>
<button onclick="setWord()"> Добавить </button>
</br></br>
<label>
	Поиск:
	<input id="search-word" placeholder="начните вводить" onchange="getTable()" oninput="getTable()">
</label>
<div id="data-table"></div>
</body>
<style>
	table td {
		padding: 8px;
		text-align: center;
	}
</style>
<script>
    fetch('req.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({method:'reinit'})
    });
    getTable();
    async function checkWord(wordElement) {
        let data = {
            method: 'check_word'
        };
        data.word = wordElement.value;
		let response = await fetch('req.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(data)
        });
        let result = await response.json();
        console.log(result);
        if (result.status) {
            element = document.getElementById('description');
            element.value = result.result
        } else {
            element = document.getElementById('description');
            element.value = '';
        }
	}
    async function getTable() {
        let data = {
            method: 'table'
        };
		element = document.getElementById('search-word');
		console.log(element.value);
		if (element.value!=='') {
            data.word = element.value;
        }
        let response = await fetch('req.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(data)
        });
        let result = await response.json();
        console.log(result);
		if (result.status) {
            element = document.getElementById('data-table');
            element.innerHTML = result.result
		} else {
            element = document.getElementById('data-table');
            element.innerHTML = "<h1>"+result.result+"</h1>";
		}
    }
    async function setWord() {
        let data = {
            method: 'set_word'
        };
        data.word = document.getElementById('word').value;
        data.description = document.getElementById('description').value;
        let response = await fetch('req.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(data)
        });
        let result = await response.json();
        console.log(result);
        if (result.status) {
            alert('success');
        } else {
            alert(result.result);
        }
        getTable();
    }
</script>
</html>
