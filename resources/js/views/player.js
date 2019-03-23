import React, { Component } from 'react';
import playerService from '../services/player';
import { DatePicker, Col, Row } from 'antd';
import DefaultLayout from '../components/layout/layout';
import moment from 'moment';
import localStorage from '../services/localStorage';
import PlayerTable from '../components/table/player-table';
import { PlayerHeader } from '../components/player/player-header';
import axios from 'axios';

const {
  RangePicker
} = DatePicker;

class PlayerPage extends Component {
  state = {
    player: {
      player:{}
    },
    gains: {},
    user: this.props.match.params.player,
    dateRange: [
      moment({ hour: 0, minute: 0, seconds: 0 }).subtract(6, 'days'),
      moment({ hour: 23, minute: 59, seconds: 59 })
    ],
    isLoading: false
  }

  componentDidMount() {
    this.getUserData();
  }

  UNSAFE_componentWillReceiveProps(nextProps) {
    if (this.props.match.params.player !== nextProps.match.params.player) {
      this.getUserData(nextProps.match.params.player);
    }
  }

  getUserData = (player) => {
    this.setState({ isLoading: true })

    playerService.getPlayerDetails(player ? player : this.state.user)
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

  updateData = () => {
    axios.post('/api/stats/record', {
      'name': this.state.player.player.name
    })
    .then(() => {
      this.getUserData();
    })
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

  render() {
    return (
      <DefaultLayout>
        <PlayerHeader
          name={this.state.player.player.name}
          lastUpdated={this.state.player.player.last_updated}
          update={this.updateData}
        />
        <RangePicker
          style={{ marginBottom: 10 }}
          ranges={{ Today: [moment(), moment()], 'This Month': [moment().startOf('month'), moment().endOf('month')] }}
          // showTime={{ format: 'HH:mm' }}
          format="YYYY-MM-DD HH:mm"
          placeholder={['Start Time', 'End Time']}
          defaultValue={this.state.dateRange}
          onChange={this.handleDateRangeChange}
        />
        <Row>
          <Col span={18}>
            <PlayerTable data={Object.values(this.state.gains)} isLoading={this.state.isLoading} />
          </Col>
        </Row>
      </DefaultLayout>
    );
  }
}

export default PlayerPage
