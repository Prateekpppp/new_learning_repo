import React, { useState } from 'react'
import Chart from './Chart';
import axios from 'axios';

function UserPolling() {
    const [apple, setApple] = useState(0);
    const [banana, setBanana] = useState(0);
    const [mango, setMango] = useState(0);
    const [chartData, setChartData] = useState({apple:apple, banana:banana, mango:mango});

    
    const submitPoll = (e) => {

        const pollData = {apple:apple,banana:banana,mango:mango} ;

        axios.post('http://localhost:3000/updatePoll', pollData)
        .then((res) => {
            console.log('res',res);
        })
        .catch((err) => {
            console.log('err---',err);
        });

    }

  return (
    <>
        <div>What is your favorite fruit?</div>

        <div>
            <div className="pollingDiv">
                <button className='apple' onClick={()=>{submitPoll(); setApple( apple + 1); setChartData(prevUser => ({...prevUser,apple: apple+1}))}}>
                    Apple
                </button>
                <div className="pollVal">
                    {apple}
                </div>
            </div>
            <div className="pollingDiv">
                <button className='banana' onClick={()=>{setBanana(banana + 1); setChartData(prevUser => ({...prevUser,banana: banana+1}))}}>
                    Banana
                </button>
                <div className="pollVal">
                    {banana}
                </div>
            </div>
            <div className="pollingDiv">
                <button className='mango' onClick={()=>{setMango( mango + 1); setChartData(prevUser => ({...prevUser,mango: mango+1}))}}>
                    Mango
                </button>   
                <div className="pollVal">
                    {mango}
                </div>             
            </div>
        </div>

        
        <Chart data={chartData} />
    </>
  )
}


export default UserPolling