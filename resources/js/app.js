
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */
require('./bootstrap');

import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import playerService from './services/player';
import { DatePicker } from 'antd';

const {
    RangePicker
} = DatePicker;

export default class App extends Component {
  state = {
    player: {},
    gains: null,
    user: "",
    dateRange: []
  }

  getUserData = () => {
    playerService.getPlayerDetails(this.state.user)
      .then(response => {
        let data = playerService.getGainsInPeriod(response.data.data.dataPoints, '2019-03-05', '2019-03-09');
        this.setState({
          player: response.data.data,
          gains: data
        })
      })
  }

  handleChange = (e) => {
    this.setState({user: e.target.value})
  }

  handleDateRangeChange = (value) => {
    this.setState({
        dateRange: value,
    }, () => {
      if (this.state.dateRange.length == 2) {
        this.setState({
          gains: playerService.getGainsInPeriod(this.state.player.dataPoints, this.state.dateRange[0], this.state.dateRange[1])
        })

        console.log(playerService.getGainsInPeriod(this.state.player.dataPoints, this.state.dateRange[0], this.state.dateRange[1]));
      }
    });
  }

  handleSubmit = (e) => {
    e.preventDefault();
    this.getUserData()
  }

  render() {
    return (
      <form onSubmit={this.handleSubmit}>
        <input type="text" onChange={this.handleChange} value={this.state.user} />
        <button type="submit">Search</button>
        <RangePicker
          showTime={{ format: 'HH:mm' }}
          format="YYYY-MM-DD HH:mm"
          placeholder={['Start Time', 'End Time']}
          onChange={this.handleDateRangeChange}
        />
      </form>
    );
  }
}

if (document.getElementById('app-root')) {
  ReactDOM.render(<App />, document.getElementById('app-root'));
}

