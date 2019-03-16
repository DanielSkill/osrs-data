import React, { Fragment } from 'react';
import { Statistic, Icon } from 'antd';
import { formatStatistic } from '../services/helpers';

const TableLevelStatistic = (props) => {
  const type = props.data > 0 ? 'arrow-up' : 'equal';
  const color = props.data > 0 && '#3f8600';

  return (
    <Fragment>
      <Statistic
        value={formatStatistic(props.data, props.suffix)}
        valueStyle={{ color: color, fontSize: 13 }}
        prefix={<Icon type={type} />}
      />
    </Fragment>
  )
}

export default TableLevelStatistic