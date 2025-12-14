import {useState, useEffect} from 'react'
import axios from 'axios';
import Table from 'react-bootstrap/Table';

function Feedback() {
  
    let data = '';
    const [feadbacks, setFeedbacks] = useState([]);

    useEffect(() => {
      axios.get('http://localhost:8080/feedbacks')
      .then((res)=>{
        data = res.data;
        setFeedbacks(data);
        
      })
      .catch((err)=>{
        console.log('err---',err);
      });
      
    }, []);

  if(feadbacks.length){
    
    return (
      <>
        <Table striped bordered hover>
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Feedback</th>
            </tr>
          </thead>
          <tbody>
            {
              feadbacks.map((item,ind)=>{
                console.log('i---',item);
                
                return (
                  <tr key={ind}>
                    {
                      Object.entries(item).map((i,j)=>{
                        console.log('i,j',i,j);
                        
                        if(i[0] != '__v' || i[0] != '_id'){
                          if(i[0] == '_id'){
                            return (
                              <td key={i[0]}>{ind+1}</td>
                            )

                          } else{
                            
                            return (
                              <td key={i[0]}>{i[1]}</td>
                            )
                          }
                        }
                        
                      })
                    }
                   </tr>
                  )
                })
            }
          </tbody>
        </Table>
      </>
    )
  } else{
    return (<h2>No Feedbacks yet</h2>
    )
  }
}

export default Feedback