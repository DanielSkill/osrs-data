import axios from 'axios';

const getPlayerDetails = (name) => {
  axios.get('/api/stats/player/' . name)
  .then((response) => {
    return response.data
  })
}

export default getPlayerDetails;