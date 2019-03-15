import axios from 'axios';
import moment from 'moment';
import skills from '../data/skills.js';


const getPlayerDetails = (name) => {
    return axios.get(`/api/stats/player/${name}`)
        .then(response => {
            return response
        })
}

const getGainsInPeriod = (dataPoints, startDate, endDate) => {
    const momentStart = moment(startDate);
    const momentEnd = moment(endDate).endOf('day');

    const filteredDataPoints = dataPoints.filter((dataPoint) => {
      return (moment(dataPoint.created_at).isBetween(momentStart, momentEnd));
    });

    let firstDataPoint = filteredDataPoints[0]
    let lastDataPoint = filteredDataPoints[filteredDataPoints.length - 1]

    return getXpDifference(firstDataPoint, lastDataPoint)
}

const getXpDifference = (firstDataPoint, lastDataPoint) => {
  let diffCollection = {};

  if (typeof firstDataPoint !== 'undefined' && typeof lastDataPoint !== 'undefined') {
    skills.data.forEach((skill) => {
      let xpDiff = lastDataPoint.data[skill].xp - firstDataPoint.data[skill].xp
      let levelDiff = lastDataPoint.data[skill].level - firstDataPoint.data[skill].level
      let rankDiff = lastDataPoint.data[skill].rank - firstDataPoint.data[skill].rank
  
      diffCollection[skill] = {
        'xpDiff': xpDiff,
        'levelDiff': levelDiff,
        'rankDiff': rankDiff,
        'currentXp': lastDataPoint.data[skill].xp
      }
    })
  } else {
    // if there is not two data points available in the range
    // return 0 for all skills
    skills.data.forEach((skill) => {
      diffCollection[skill] = {
        'xpDiff': 0,
        'levelDiff': 0,
        'rankDiff': 0,
        'currentXp': 0
      }
    })
  }

  return diffCollection;
}

export default {
  getPlayerDetails,
  getXpDifference,
  getGainsInPeriod
}

