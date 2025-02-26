let arrayProblems = {

    // Search an Element in an array
    'searchElement' : (arr,el)=>{
        let arrL = arr.length;
        
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


console.log(arrayProblems.beautifulString('1000'));