
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */
require('./bootstrap');

import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import playerService from './services/player';

export default class App extends Component {
  state = {
    player: {},
    gains: null,
    startDate: null,
    endDate: null,
    user: ""
  }

  getUserData = () => {
    playerService.getPlayerDetails(this.state.user)
      .then(response => {
        let data = playerService.getGainsInPeriod(response.data.data.dataPoints, '2019-03-07', '2019-03-08');
        console.log(data);

        this.setState({
          player: response.data.data,
          gains: data
        })
      })
  }

  handleChange = (e) => {
    this.setState({user: e.target.value})
  }

  handleSubmit = (e) => {
    e.preventDefault();
    this.getUserData()
  }

  render() {
    return (
      <form onSubmit={this.handleSubmit}>
        <input type="text" onChange={this.handleChange} value={this.state.user} />
      </form>
    );
  }
}

if (document.getElementById('app-root')) {
  ReactDOM.render(<App />, document.getElementById('app-root'));
}

