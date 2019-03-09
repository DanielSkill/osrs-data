import React, { Fragment } from 'react';
import { Statistic, Icon } from 'antd';

const TableLevelStatistic = (props) => {
  const type = props.data > 0 && 'arrow-up';
  const color = props.data > 0 && '#3f8600';

  return (
    <Fragment>
      <Statistic
        value={props.data}
        valueStyle={{ color: color, fontSize: 13 }}
        prefix={<Icon type={type} />}
      />
    </Fragment>
  )
}

export default TableLevelStatistic