// get column number using theee given column name in sheet

let dsa2 = {

    'colNum' : (txt)=>{

    },

    'utils' : {
        'getPower' : (base, expo)=>{
            let res = 1;
            while(expo > 0){
                res = res * base;
                expo -= 1;
            }
            return res;
        }
    }
}


let colNum = function (txt){
    let alphabets = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
    let txtLength = txt.length;
    let letterOneVal = 0;
    let colNum = 0;
    let i = 0;
    while(txtLength > 0){
        letterOneVal = alphabets.indexOf(txt[i]);
        colNum += (letterOneVal + 1) * dsa2.utils.getPower(26,txtLength-1);
        txtLength -= 1;
        i += 1;
    }

    return colNum;
}


console.log(colNum('aa'));
