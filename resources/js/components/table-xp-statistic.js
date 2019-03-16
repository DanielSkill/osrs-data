import React, { Fragment } from 'react';
import { Statistic } from 'antd';
import { formatStatistic } from '../services/helpers';

const TableXpStatistic = (props) => {
  const type = props.data > 0 && 'arrow-up';
  const color = props.data > 0 && '#3f8600';

  return (
    <Fragment>
      <Statistic
        value={formatStatistic(props.data, props.suffix)}
        valueStyle={{ color: color, fontSize: 13 }}
      />
    </Fragment>
  )
}

export default TableXpStatistic