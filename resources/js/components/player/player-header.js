import React from 'react';
import { PageHeader, Tag, Button } from 'antd';

export const PlayerHeader = (props) => {
  return (
    <PageHeader
      backIcon={false}
      title={props.name}
      subTitle="Current Rank: 1193 | Today's Rank: 1"
      tags={<Tag color="green">Updated: {props.lastUpdated}</Tag>}
      extra={[
        <Button key="2">Change Name</Button>,
        <Button key="1" type="primary" onClick={props.update}>
          Refresh
        </Button>,
      ]}
    >
    </PageHeader>
  )
}