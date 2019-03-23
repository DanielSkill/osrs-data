


import React, { Component } from 'react';

import playerService from '../services/player';
import { DatePicker, AutoComplete, Form, Button } from 'antd';
import DefaultLayout from '../components/layout/layout';
import moment from 'moment';
import localStorage from '../services/localStorage';
import PlayerTable from '../components/table/player-table';

const {
  RangePicker
} = DatePicker;

class PlayerPage extends Component {
  state = {
    player: {},
    gains: {},
    user: "",
    dateRange: [
      moment({ hour: 0, minute: 0, seconds: 0 }).subtract(6, 'days'),
      moment({ hour: 23, minute: 59, seconds: 59 })
    ],
    isLoading: false
  }

  getUserData = () => {
    this.setState({ isLoading: true })

    playerService.getPlayerDetails(this.state.user)
      .then(response => {
        if (response.status !== 404) {
          this.setState({
            player: response.data.data,
            gains: playerService.getGainsInPeriod(response.data.data.dataPoints, this.state.dateRange[0], this.state.dateRange[1]),
            isLoading: false
          })
  
          // only save them as a search if data was found
          if (response.data.data.dataPoints.length > 0) {
            localStorage.addItem('searches', this.state.user)
          
          }
        }
      })
  }

  handleChange = (value) => {
    this.setState({ user: value })
  }

  handleDateRangeChange = (value) => {
    this.setState({
      dateRange: value,
    }, () => {
      if (this.state.dateRange.length == 2 && Object.keys(this.state.player).length !== 0) {
        this.setState({
          gains: playerService.getGainsInPeriod(this.state.player.dataPoints, this.state.dateRange[0], this.state.dateRange[1])
        })
      }
    });
  }

  handleSubmit = (e) => {
    e.preventDefault();
    this.getUserData();
  }

  render() {
    return (
      <DefaultLayout>
        <Form layout="inline" onSubmit={this.handleSubmit}>
          <Form.Item>
            <AutoComplete
              value={this.state.user}
              placeholder="Username"
              dataSource={localStorage.getItem('searches', [])}
              onChange={this.handleChange}
              style={{ width: 200 }}
              filterOption
              allowClear
            />
          </Form.Item>
          <Form.Item>
            <RangePicker
              showTime={{ format: 'HH:mm' }}
              format="YYYY-MM-DD HH:mm"
              placeholder={['Start Time', 'End Time']}
              defaultValue={this.state.dateRange}
              onChange={this.handleDateRangeChange}
            />
          </Form.Item>
            <Form.Item>
              <Button
                type="primary"
                htmlType="submit"
              >
                Find
            </Button>
          </Form.Item>
        </Form>
        <PlayerTable data={Object.values(this.state.gains)} isLoading={this.state.isLoading} />
      </DefaultLayout>
    );
  }
}

export default PlayerPage
