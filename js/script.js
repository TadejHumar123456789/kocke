


function vrzi(){
    document.getElementById("gumb").disabled = true;

    let meti = [];
    let max = 0;
    let winners = [];

    for(let i = 0; i < players.length; i++){
        let s1 = Math.floor(Math.random() * 6) + 1;
        let s2 = Math.floor(Math.random() * 6) + 1;
        let s3 = Math.floor(Math.random() * 6) + 1;
        let sum = s1 + s2 + s3;

        meti.push({
            kocke: [s1, s2, s3],
            vsota: sum
        });

        if(sum > max){
            max = sum;
            winners = [players[i].ime + " " + players[i].priimek];
        }else if(sum == max){
            winners.push(players[i].ime + " " + players[i].priimek);
        }
    }

    let html = '<div class="players-wrap">';

    for(let i = 0; i < players.length; i++){
        html += `
            <div class="player">
                <h2>${players[i].ime} ${players[i].priimek}</h2>
                <p><b>Naslov:</b> ${players[i].naslov}</p>

                <div id="dice${i}">
                    <img src="./images/dice-anim.gif">
                    <img src="./images/dice-anim.gif">
                    <img src="./images/dice-anim.gif">
                </div>

                <h3 id="vsota${i}"></h3>
            </div>
        `;
    }

    html += '</div>';

    document.getElementById("rezultat").innerHTML = html;

    setTimeout(() => {
        for(let i = 0; i < players.length; i++){
            document.getElementById("dice" + i).innerHTML = `
                <img src="./images/dice${meti[i].kocke[0]}.gif">
                <img src="./images/dice${meti[i].kocke[1]}.gif">
                <img src="./images/dice${meti[i].kocke[2]}.gif">
            `;

            document.getElementById("vsota" + i).innerHTML = "Vsota: " + meti[i].vsota;
        }

        document.getElementById("rezultat").innerHTML += `
            <h1 class="winner">Zmagovalec/i: ${winners.join(", ")}</h1>
        `;
    }, 2000);

    setTimeout(() => {
        window.location.href = "../index.php";
    }, 10000);
}

