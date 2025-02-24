
let stringFunctions = {
    // Reverse String Word Wise
    'reverseWords' : 
        function(txt){
            console.log(txt);
            let txtL = txt.length;
            let i = 0;
            let t_txt = '';
        
            let r_txt_arr = [];
        
            while(i < txtL){
                if(txt[i] == ' '){
                    r_txt_arr.push(t_txt);
                    t_txt = '';
                } else {
                    t_txt += txt[i];
                }
                i += 1;
            }
            i = r_txt_arr.length-1;
            while(i > -1){
                t_txt += ' ' + r_txt_arr[i];
                i -= 1;
            }
            
            return t_txt;
        },
    
    // String Encoding
    'strEncode' : function (txt) {
        let strOut = '';
        let strL = txt.length;
        let i = 1;
        let cnt = 1;
        let t_txt = txt[0];

        while(i < strL){
            if(txt[i] == txt[i-1]){
                cnt += 1;
            } else{
                t_txt += cnt + txt[i];
                cnt = 1
            }

            i += 1
        }

        return t_txt+cnt;
    },

    // Beautiful String
    'beautifulString' : function(txt){
        let i = 1;
        let fstVar = txt[0];
        let opCnt = 0;

        while(i < txt.length){
            console.log('~txt[i]',~txt[i]);
            if((i+1)%2==0){
                
                if(txt[i] === fstVar){
                    txt[i] = ~txt[i];
                    opCnt += 1;
                }
            } else{
                if(txt[i] !== fstVar){
                    txt[i] = ~txt[i];
                    opCnt += 1;
                }
            }
            i += 1;
            
        }
        return opCnt,txt;


    }
}


console.log(stringFunctions.beautifulString('1000'));