import axios from 'axios';
import moment from 'moment';
import skills from '../data/skills.js';


const getPlayerDetails = (name) => {
    axios.get('/api/stats/player/'.name)
        .then((response) => {
            return response.data
        })
}

const getGainsInPeriod = (player, startDate, endDate) => {
    const dataPoints = player.dataPoints
    const momentStart = moment(startDate);
    const momentEnd = moment(endDate).endOf('day');

    const filteredDataPoints = dataPoints.filter((dataPoint) => {
      return (moment(dataPoint.created_at).isBetween(momentStart, momentEnd));
    });

    const firstDataPoint = filteredDataPoints[0]
    const lastDataPoint = filteredDataPoints[filteredDataPoints.length - 1]

    return getXpDifference(firstDataPoint, lastDataPoint)
}

const getXpDifference = (firstDataPoint, lastDataPoint) => {
  let diffCollection = [];

  skills.data.forEach((skill) => {
    let xpDiff = lastDataPoint.data[skill].xp - firstDataPoint.data[skill].xp
    let levelDiff = lastDataPoint.data[skill].level - firstDataPoint.data[skill].level
    let rankDiff = lastDataPoint.data[skill].rank - firstDataPoint.data[skill].rank

    diffCollection[skill] = {
      'xpDiff': xpDiff,
      'levelDiff': levelDiff,
      'rankDiff': rankDiff,
    }
  })

  return diffCollection;
}

export default {
  getPlayerDetails,
  getXpDifference,
  getGainsInPeriod
}

