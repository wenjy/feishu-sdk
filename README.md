## 简介

内核代码架构来自：（[https://github.com/w7corp/easywechat](https://github.com/w7corp/easywechat)）

飞书 ([https://feishu.cn](https://feishu.cn)) 服务接口 Sdk.

## 文档
飞书服务接口文档 ([https://open.feishu.cn/document/ukTMukTMukTM/uADN14CM0UjLwQTN](https://open.feishu.cn/document/ukTMukTMukTM/uADN14CM0UjLwQTN))

## 功能
- [ ] 授权
    - [x] 获取 app_access_token（企业自建应用）
    - [ ] 获取 app_access_token（应用商店应用）
    - [ ] 获取 tenant_access_token（企业自建应用）
    - [ ] 获取 tenant_access_token（应用商店应用）
    - [ ] 重新推送 app_ticket
    - [ ] [查询租户授权状态](https://bytedance.feishu.cn/docs/doccnHJx2UbLZh5kiWjNawICyNd#dCNL6V)
    - [ ] [申请授权](https://bytedance.feishu.cn/docs/doccnHJx2UbLZh5kiWjNawICyNd#kHHiAa)
- [ ] 身份验证
    - [ ] 请求身份验证
    - [ ] 获取登录用户身份
    - [ ] 刷新access_token
    - [ ] 获取用户信息
- [ ] 事件订阅
- [ ] 通讯录
    - [ ] 用户
        - [ ] 创建用户
        - [x] 获取单个用户信息
        - [x] 获取部门直属用户列表
        - [ ] 修改用户部分信息
        - [ ] 更新用户所有信息
        - [ ] 删除用户
        - [ ] 通过手机号或邮箱获取用户 ID
    - [ ] 部门
        - [ ] 创建部门
        - [x] 获取单个部门信息
        - [x] 获取子部门列表
        - [ ] 获取父部门信息
        - [ ] 搜索部门
        - [ ] 修改部分部门信息
        - [ ] 更新部门所有信息
        - [ ] 删除部门
    - [ ] 用户组
        - [ ] 创建用户组
        - [ ] 更新用户组
        - [ ] 删除用户组
        - [ ] 查询用户组
        - [ ] 查询用户组列表
        - [ ] 用户组成员
            - [ ] 添加用户组成员
            - [ ] 移除用户组成员
            - [ ] 查询用户组成员列表
    - [ ] 单位
        - [ ] 创建单位
        - [ ] 修改单位信息
        - [ ] 删除单位
        - [ ] 获取单位信息
        - [ ] 批量获取单位列表
        - [ ] 建立部门与单位的绑定关系
        - [ ] 解除部门与单位的绑定关系
        - [ ] 获取单位绑定的部门列表
    - [ ] 人员类型
        - [ ] 查询人员类型
        - [ ] 更新人员类型
        - [ ] 删除人员类型
        - [ ] 新增人员类型
    - [ ] 自定义用户字段
        - [ ] 获取企业自定义用户字段
    - [ ] 通讯录授权范围
        - [ ] 获取通讯录授权范围
- [ ] 消息与群组
    - [ ] 消息
        - [ ] 发送消息
        - [ ] 回复消息
        - [ ] 撤回消息
        - [ ] 查询消息已读信息
        - [ ] 获取会话历史消息
        - [ ] 获取消息中的资源文件
        - [ ] 获取指定消息的内容
        - [ ] 加急操作
            - [ ] 发送应用内加急
            - [ ] 发送短信加急
            - [ ] 发送电话加急
    - [ ] 批量消息
        - [ ] 批量发送消息
        - [ ] 批量撤回消息
        - [ ] 查询批量消息推送和阅读人数
        - [ ] 查询批量消息整体进度
    - [ ] 图片消息
        - [ ] 上传图片
        - [ ] 下载图片
    - [ ] 文件消息
        - [ ] 上传文件
        - [ ] 下载文件
    - [ ] 消息卡片
        - [ ] 更新应用发送的消息
        - [ ] 消息卡片延迟更新
        - [ ] 临时消息卡片
            - [ ] 发送「仅你可见」的临时消息
            - [ ] 删除「仅你可见」的临时消息
    - [ ] 表情回复
        - [ ] 添加消息表情回复
        - [ ] 获取消息表情回复
        - [ ] 删除消息表情回复
    - [ ] 群组
        - [ ] 创建群
        - [ ] 获取群信息
        - [ ] 更新群信息
        - [ ] 解散群
        - [ ] 获取用户或机器人所在的群列表
        - [ ] 搜索对用户或机器人可见的群列表
        - [ ] 获取群成员发言权限
        - [ ] 更新群发言权限
    - [ ] 群成员
        - [ ] 将用户或机器人拉入群聊
        - [ ] 将用户或机器人移出群聊
        - [ ] 用户或机器人主动加入群聊
        - [ ] 获取群成员列表
        - [ ] 判断用户或机器人是否在群里
        - [ ] 指定群管理员
        - [ ] 删除群管理员
    - [ ] 群公告
        - [ ] 获取群公告信息
        - [ ] 更新群公告信息
    
- [ ] 云文档
- [ ] 日历
- [ ] 视频会议
- [ ] 会议室
- [ ] 考勤打卡
- [ ] 审批
    - [ ] 查看审批定义
    - [ ] 批量获取审批实例
    - [x] 获取单个审批实例详情
    - [x] 创建审批实例
    - [ ] 审批任务同意
    - [ ] 审批任务拒绝
    - [ ] 审批任务转交
    - [ ] 审批任务退回
    - [ ] 审批实例撤回
    - [ ] 审批实例抄送
    - [ ] 审批任务加签
    - [ ] 审批流程预览
    - [ ] 上传文件
    - [ ] 用户角度列出任务
    - [ ] 实例列表查询
    - [ ] 抄送列表查询
    - [ ] 三方审批
    - [ ] 三方应用审批
- [ ] 服务台
- [ ] 任务
- [ ] 邮箱
- [ ] 应用消息
- [ ] 企业消息
- [ ] 搜索
- [ ] AI能力
- [ ] 管理后台
- [ ] 智能人事
- [ ] 招聘
- [ ] OKR
- [ ] 实名认证
- [ ] 智能门禁
- [ ] 企业百科

## 参考
* 飞书官方文档 https://open.feishu.cn/document/uQjL04CN/ucDOz4yN4MjL3gzM
