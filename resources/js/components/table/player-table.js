import React from 'react';
import { Table } from 'antd';
import TableRankStatistic from './table-rank-statistic';
import TableLevelStatistic from './table-level-statistic';
import TableXpStatistic from './table-xp-statistic';
import skills from '../../data/skills';

const columns = [
  {
    title: 'skill',
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

class PlayerTable extends React.PureComponent {
  render() {
    return (
      <Table
        columns={columns}
        dataSource={this.props.data}
        size='small'
        pagination={false}
        loading={this.props.isLoading}
      />
    )
  }
}

export default PlayerTable