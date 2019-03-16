


import React, { Component } from 'react';

import playerService from '../services/player';
import { DatePicker, Table, Input } from 'antd';
import skills from '../data/skills';
import DefaultLayout from '../components/layout';
import TableRankStatistic from '../components/table-rank-statistic';
import TableLevelStatistic from '../components/table-level-statistic';
import TableXpStatistic from '../components/table-xp-statistic';
import moment from 'moment'

const {
  RangePicker
} = DatePicker;

const {
  Search
} = Input;

const columns = [
  {
    title: 'Skill',
    key: 'skill',
    fixed: 'left',
    width: 20,
    render: (text, record, index) => <img src={`/images/skill-icons/${skills.data[index].toLowerCase()}.gif`} height={16} width={16} />,
  },
  {
    title: 'xp',
    dataIndex: 'xpDiff',
    key: 'xpDiff',
    render: (text, record) => <TableXpStatistic data={text} suffix={record.currentXp} />
  },
  {
    title: 'level',
    dataIndex: 'levelDiff',
    key: 'levelDiff',
    render: (text, record) => <TableLevelStatistic data={text} suffix={record.currentLevel} />
  },
  {
    title: 'rank',
    dataIndex: 'rankDiff',
    key: 'rankDiff',
    render: (text, record) => <TableRankStatistic data={text} suffix={record.currentRank} />
  },
]

export default class PlayerPage extends Component {
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
        this.setState({
          player: response.data.data,
          gains: playerService.getGainsInPeriod(response.data.data.dataPoints, this.state.dateRange[0], this.state.dateRange[1]),
          isLoading: false
        })
      })
  }

  handleChange = (e) => {
    this.setState({ user: e.target.value })
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

  handleSubmit = () => {
    this.getUserData()
  }

  render() {
    return (
      <DefaultLayout>
        <form onSubmit={this.handleSubmit}>
          <Search
            placeholder="Username"
            onChange={this.handleChange}
            onSearch={this.handleSubmit}
            style={{ width: 200 }}
          />
          <RangePicker
            showTime={{ format: 'HH:mm' }}
            format="YYYY-MM-DD HH:mm"
            placeholder={['Start Time', 'End Time']}
            defaultValue={this.state.dateRange}
            onChange={this.handleDateRangeChange}
          />
          <Table
            columns={columns}
            dataSource={Object.values(this.state.gains)}
            size='small'
            pagination={false}
            loading={this.state.isLoading}
          />
        </form>
      </DefaultLayout>
    );
  }
}



