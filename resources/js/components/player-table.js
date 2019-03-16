import React from 'react';
import { Table } from 'antd';
import TableRankStatistic from '../components/table-rank-statistic';
import TableLevelStatistic from '../components/table-level-statistic';
import TableXpStatistic from '../components/table-xp-statistic';
import skills from '../data/skills';

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

const PlayerTable = (props) => {
  return (
    <Table
      columns={columns}
      dataSource={props.data}
      size='small'
      pagination={false}
      loading={props.isLoading}
    />
  )
}

export default PlayerTable